<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/carts',[CartController::class, 'index'])->name('carts');

    Route::post('/carts/add/{productId}', [CartController::class, 'add'])->name('cart.add');

    Route::delete('/carts/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
});