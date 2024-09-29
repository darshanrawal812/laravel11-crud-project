<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

// Routes 
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/create', 'create')->name('products.create');
    Route::post('/products', 'store')->name('products.store');
    Route::delete('/products/{id}', 'destroy')->name('products.destroy');
    Route::get('/products/{id}/edit', 'edit')->name('products.edit');
    Route::put('/products/{id}', 'update')->name('products.update');
});
