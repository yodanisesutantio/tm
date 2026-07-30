<?php

namespace App\Http\Controllers;

use App\Models\M90CAF9;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index(Request $request, ProductsController $productsController)
    {
        $activeTab = $request->query('tab', 'transactions');

        $data = [
            'activeTab'      => $activeTab,
            'products'       => collect(),
            'totalProducts'  => 0,
            'categories'     => ['Barang Jadi', 'Bahan Baku', 'Aset', 'Material'],
            'search'         => null,
            'editingProduct' => null,
        ];

        if ($activeTab === 'products') {
            $productData = $productsController->getProductsData($request);
            $data = array_merge($data, $productData);

            if ($request->filled('edit')) {
                $data['editingProduct'] = M90CAF9::where('uuid', $request->query('edit'))->first();
            }
        }

        return view('app', $data);
    }
}
