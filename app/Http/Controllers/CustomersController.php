<?php

namespace App\Http\Controllers;

use App\Models\M5D3140;
use App\Models\MA56F63;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomersController extends Controller
{
    public function getCustomersData(Request $request): array
    {
        $search = $request->input('search');

        $customers = M5D3140::query()
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalCustomers = M5D3140::count();

        return [
            'customers'         => $customers,
            'totalCustomers'    => $totalCustomers,
            'search'            => $search,
            'provinces'         => M5D3140::distinct()->pluck('province')->filter()->values()->toArray(),
            'cities'            => M5D3140::distinct()->pluck('city')->filter()->values()->toArray(),
        ];
    }

    public function saveCustomersData(Request $request)
    {
        $customerUuid = $request->input('uuid');

        $validatedData = M5D3140::validate($request->all(), $customerUuid);

        M5D3140::upsert(
            [
                [
                    'uuid'        => $customerUuid ?: (string) Str::uuid(),
                    'code'        => $validatedData['code'] ?? null,
                    'name'        => $validatedData['name'] ?? null,
                    'address'     => $validatedData['address'] ?? null,
                    'province'    => $validatedData['province'] ?? null,
                    'city'        => $validatedData['city'] ?? null,
                    'district'    => $validatedData['district'] ?? null,
                    'subdistrict' => $validatedData['subdistrict'] ?? null,
                    'postal_code' => $validatedData['postal_code'] ?? null,
                    'updated_at'  => now(),
                ]
            ],
            ['uuid'],
            ['code', 'name', 'address', 'province', 'city', 'district', 'subdistrict', 'postal_code', 'updated_at']
        );

        $message = $customerUuid ? 'Pelanggan berhasil diperbarui!' : 'Pelanggan berhasil ditambahkan!';

        return redirect()->route('hub', ['tab' => 'customers'])
            ->with('success', $message);
    }

    public function deleteCustomersData(string $uuid)
    {
        $customer = M5D3140::where('uuid', $uuid)->firstOrFail();

        $hasTransactions = MA56F63::where('cust_uuid', $customer->uuid)->exists();

        if ($hasTransactions) {
            return redirect()->route('hub', ['tab' => 'customers'])
                ->with('error', 'Pelanggan tidak bisa dihapus karena sudah memiliki riwayat transaksi.');
        }

        $customer->delete();

        return redirect()->route('hub', ['tab' => 'customers'])
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}
