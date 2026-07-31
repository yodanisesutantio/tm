<?php

namespace App\Http\Controllers;

use App\Models\M90CAF9;
use App\Models\MA56F64;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function getProductsData(Request $request): array
    {
        $search = $request->input('search');

        $products = M90CAF9::query()
            ->when($search, function ($query, $search) {
                $query->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $existingCategories = M90CAF9::distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->toArray();

        $categories = array_values(array_unique(array_merge(
            ['Barang Jadi', 'Bahan Baku', 'Aset', 'Material'],
            $existingCategories
        )));

        return [
            'products'       => $products,
            'totalProducts'  => M90CAF9::count(),
            'categories'     => $categories,
            'search'         => $search,
        ];
    }

    public function saveProductsData(Request $request)
    {
        $productUuid = $request->input('uuid');
        $request->merge([
            'price' => str_replace(',', '.', $request->input('price')),
            'stock' => str_replace(',', '.', $request->input('stock')),
        ]);

        $validatedData = M90CAF9::validate($request->all(), $productUuid);

        M90CAF9::upsert(
            [
                [
                    'uuid'       => $productUuid ?: (string) Str::uuid(),
                    'category'   => $validatedData['category'],
                    'code'       => $validatedData['code'],
                    'name'       => $validatedData['name'],
                    'price'      => $validatedData['price'] ?? 0,
                    'stock'      => $validatedData['stock'] ?? 0,
                    'updated_at' => now(),
                ]
            ],
            ['uuid'],
            ['category', 'code', 'name', 'price', 'stock', 'updated_at']
        );

        $message = $productUuid ? 'Produk berhasil diperbarui!' : 'Produk berhasil ditambahkan!';

        return redirect()->route('hub', ['tab' => 'products'])
            ->with('success', $message);
    }

    public function deleteProductsData(string $uuid)
    {
        $product = M90CAF9::where('uuid', $uuid)->firstOrFail();

        $hasTransactions = MA56F64::where('product_uuid', $product->uuid)->exists();

        if ($hasTransactions) {
            return redirect()->route('hub', ['tab' => 'products'])
                ->with('error', 'Produk tidak bisa dihapus karena sudah digunakan dalam transaksi.');
        }

        $product->delete();

        return redirect()->route('hub', ['tab' => 'products'])
            ->with('success', 'Produk berhasil dihapus!');
    }
}
