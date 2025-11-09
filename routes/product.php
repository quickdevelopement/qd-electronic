<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
   Route::get('/dashboard/products', [ProductController::class, 'productsdb'])->name('dashboard.products');
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('dashboard.products.create');
    Route::post('/dashboard/products/store', [ProductController::class, 'store'])->name('dashboard.products.store');
    Route::get('/dashboard/products/{product}/edit', [ProductController::class, 'edit'])->name('dashboard.products.edit');
    Route::patch('/dashboard/products/{product}/update', [ProductController::class, 'update'])->name('dashboard.products.update');
    Route::delete('/dashboard/products/{product}/delete', [ProductController::class, 'destroy'])->name('dashboard.products.delete');
    
});


Route::get('/', function () {
    $products = Product::latest()->take(3)->get();
    return view('frontend.index', ['products' => $products]);
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');




