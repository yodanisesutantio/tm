<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'transactions');
        $products = null;
        $editingProduct = null;

        if ($activeTab === 'products') {
            // $products = Product::latest()->paginate(10);
            // if ($request->has('edit')) {
            //     $editingProduct = Product::find($request->query('edit'));
            // }
        }

        return view('app', compact('activeTab', 'products', 'editingProduct'));
    }
}