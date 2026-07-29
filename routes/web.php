<?php

use App\Http\Controllers\HubController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', [HubController::class, 'index'])->name('hub');
    // Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    // Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
