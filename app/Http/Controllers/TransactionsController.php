<?php

namespace App\Http\Controllers;

use App\Models\M5D3140;
use App\Models\M90CAF9;
use App\Models\MA56F63;
use App\Models\MA56F64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    public function saveTransactionsData(Request $request)
    {
        $request->validate([
            'cust_code'    => 'required|string',
            'inv_date'     => 'required|date',
            'details'      => 'required|array|min:1',
            'details.*.product_code' => 'required|string',
            'details.*.qty'          => 'required|integer|min:1',
            'details.*.price'        => 'required|numeric|min:0',
        ], [
            'cust_code.required'          => 'Pelanggan wajib dipilih.',
            'inv_date.required'           => 'Tanggal invoice wajib diisi.',
            'details.required'            => 'Minimal harus ada 1 barang dalam transaksi.',
            'details.*.product_code.required' => 'Kode produk wajib dipilih.',
            'details.*.qty.min'           => 'Jumlah barang minimal 1.',
        ]);

        return DB::transaction(function () use ($request) {

            foreach ($request->details as $item) {
                $product = M90CAF9::where('code', $item['product_code'])->first();

                if (!$product) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Produk dengan kode '{$item['product_code']}' tidak ditemukan.");
                }

                if ($item['qty'] > $product->stock) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Stok untuk produk {$product->name} ({$product->code}) tidak mencukupi! Sisa stok: {$product->stock}, Diminta: {$item['qty']}");
                }
            }

            $invDate = \Carbon\Carbon::parse($request->inv_date);
            $yearMonth = $invDate->format('ym');
            $prefix = "INV/{$yearMonth}/";

            $lastInvoice = MA56F63::where('no_inv', 'LIKE', "{$prefix}%")
                ->orderBy('no_inv', 'desc')
                ->first();

            if ($lastInvoice) {
                $lastSequence = (int) substr($lastInvoice->no_inv, -4);
                $newSequence = str_pad($lastSequence + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newSequence = '0001';
            }

            $noInv = $prefix . $newSequence;

            $customer = M5D3140::where('code', $request->cust_code)->first();

            $headerUuid = (string) Str::uuid();
            $grandTotal = 0;

            $header = MA56F63::create([
                'uuid'         => $headerUuid,
                'no_inv'       => $noInv,
                'inv_date'     => $invDate->format('Y-m-d'),
                'cust_uuid'    => $customer->uuid ?? null,
                'cust_code'    => $request->cust_code,
                'cust_name'    => $customer->name ?? $request->cust_name,
                'cust_address' => $customer->address ?? $request->cust_address,
                'total'        => 0,
            ]);

            foreach ($request->details as $item) {
                $product = M90CAF9::where('code', $item['product_code'])->first();

                $qty = (int) $item['qty'];
                $price = (float) $item['price'];
                $discountsJson = isset($item['discounts_json']) ? json_decode($item['discounts_json'], true) : [];
                $netPrice = isset($item['net_price']) ? (float) $item['net_price'] : $price;
                $subtotal = isset($item['subtotal']) ? (float) $item['subtotal'] : ($netPrice * $qty);

                $grandTotal += $subtotal;

                MA56F64::create([
                    'uuid'           => (string) Str::uuid(),
                    'detail_uuid'    => $headerUuid,
                    'detail_no_inv'  => $noInv,
                    'product_uuid'   => $product->uuid,
                    'product_code'   => $product->code,
                    'product_name'   => $product->name,
                    'qty'            => $qty,
                    'price'          => $price,
                    'discounts_json' => $discountsJson,
                    'net_price'      => $netPrice,
                    'subtotal'       => $subtotal,
                ]);

                $product->decrement('stock', $qty);
            }

            $header->update(['total' => $grandTotal]);

            return redirect()->route('hub', ['tab' => 'transactions'])
                ->with('success', "Transaksi berhasil disimpan! Nomor Invoice: {$noInv}");
        });
    }

    public function deleteTransactionsData(string $uuid)
    {
        return DB::transaction(function () use ($uuid) {
            $header = MA56F63::where('uuid', $uuid)->firstOrFail();

            $items = MA56F64::where('detail_uuid', $header->uuid)->get();

            foreach ($items as $item) {
                $product = M90CAF9::where('uuid', $item->product_uuid)->first();
                if ($product) {
                    $product->increment('stock', $item->qty);
                }
                $item->delete();
            }

            $header->delete();

            return redirect()->route('hub', ['tab' => 'transactions'])
                ->with('success', "Transaksi {$header->no_inv} berhasil dihapus dan stok telah dikembalikan!");
        });
    }
}
