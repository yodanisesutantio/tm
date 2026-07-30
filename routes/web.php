<?php

use App\Http\Controllers\HubController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HubController::class, 'index'])->name('hub');
Route::post('/products', [ProductsController::class, 'saveProductsData'])->name('products.save');
Route::delete('/products/{uuid}', [ProductsController::class, 'deleteProductsData'])->name('products.delete');
