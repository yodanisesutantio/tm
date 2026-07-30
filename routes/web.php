<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HubController::class, 'index'])->name('hub');
Route::post('/products', [ProductsController::class, 'saveProductsData'])->name('products.save');
Route::delete('/products/{uuid}', [ProductsController::class, 'deleteProductsData'])->name('products.delete');
Route::post('/customers', [CustomersController::class, 'saveCustomersData'])->name('customers.save');
Route::delete('/customers/{uuid}', [CustomersController::class, 'deleteCustomersData'])->name('customers.delete');
