<?php

namespace App\Http\Controllers;

use App\Models\M5D3140; // Customer Model
use App\Models\M90CAF9; // Product Model
use App\Models\MA56F63; // Transaction Header Model
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
            'search'          => $request->query('search'),
            'editingProduct'  => null,
            'customers'       => collect(),
            'totalCustomers'  => 0,
            'editingCustomer' => null,
            'customerOptions' => [],
            'transactions'    => collect(),
            'totalTransactions' => 0,
            'nextNoInv'       => '',
        ];

        if ($activeTab === 'transactions') {
            $customers = M5D3140::all();
            $data['customers'] = $customers;
            $data['customerOptions'] = $customers->map(function ($c) {
                return [
                    'value' => $c->code,
                    'label' => "{$c->code} - {$c->name}",
                    'data'  => [
                        'name'    => $c->name,
                        'address' => $c->address,
                    ]
                ];
            })->toArray();

            $data['products'] = M90CAF9::all()->map(function ($p) {
                return [
                    'uuid'  => $p->uuid,
                    'code'  => $p->code,
                    'name'  => $p->name,
                    'price' => (float) ($p->price ?? 0),
                    'stock' => (int) ($p->stock ?? 0),
                ];
            })->toArray();

            $query = MA56F63::with('items')->orderBy('created_at', 'desc');

            if ($request->filled('search')) {
                $search = $request->query('search');
                $query->where(function($q) use ($search) {
                    $q->where('no_inv', 'LIKE', "%{$search}%")
                      ->orWhere('cust_name', 'LIKE', "%{$search}%")
                      ->orWhere('cust_code', 'LIKE', "%{$search}%");
                });
            }

            $data['transactions'] = $query->paginate(10)->withQueryString();
            $data['totalTransactions'] = $data['transactions']->total();

            $yearMonth = date('ym');
            $prefix = "INV/{$yearMonth}/";
            $lastInvoice = MA56F63::where('no_inv', 'LIKE', "{$prefix}%")
                ->orderBy('no_inv', 'desc')
                ->first();

            if ($lastInvoice) {
                $lastSeq = (int) substr($lastInvoice->no_inv, -4);
                $nextSeq = str_pad($lastSeq + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextSeq = '0001';
            }
            $data['nextNoInv'] = $prefix . $nextSeq;
        } elseif ($activeTab === 'products') {
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
