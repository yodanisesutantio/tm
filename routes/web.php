<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HubController::class, 'index'])->name('hub');
Route::post('/products', [ProductsController::class, 'saveProductsData'])->name('products.save');
Route::delete('/products/{uuid}', [ProductsController::class, 'deleteProductsData'])->name('products.delete');
Route::post('/customers', [CustomersController::class, 'saveCustomersData'])->name('customers.save');
Route::delete('/customers/{uuid}', [CustomersController::class, 'deleteCustomersData'])->name('customers.delete');
Route::post('/transactions', [TransactionsController::class, 'saveTransactionsData'])->name('transactions.save');
Route::delete('/transactions/{uuid}', [TransactionsController::class, 'deleteTransactionsData'])->name('transactions.delete');
