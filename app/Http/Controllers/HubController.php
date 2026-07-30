<?php

namespace App\Http\Controllers;

use App\Models\M5D3140;
use App\Models\M90CAF9;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index(Request $request, ProductsController $productsController, CustomersController $customersController)
    {
        $activeTab = $request->query('tab', 'transactions');

        $data = [
            'activeTab'       => $activeTab,
            'products'        => collect(),
            'totalProducts'   => 0,
            'categories'      => ['Barang Jadi', 'Bahan Baku', 'Aset', 'Material'],
            'search'          => null,
            'editingProduct'  => null,
            'customers'       => collect(),
            'totalCustomers'  => 0,
            'editingCustomer' => null,
        ];

        if ($activeTab === 'products') {
            $data = array_merge($data, $productsController->getProductsData($request));

            if ($request->filled('edit')) {
                $data['editingProduct'] = M90CAF9::where('uuid', $request->query('edit'))->first();
            }
        } elseif ($activeTab === 'customers') {
            $data = array_merge($data, $customersController->getCustomersData($request));

            if ($request->filled('edit')) {
                $data['editingCustomer'] = M5D3140::where('uuid', $request->query('edit'))->first();
            }
        }

        return view('app', $data);
    }
}
