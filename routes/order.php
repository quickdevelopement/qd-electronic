<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');


    Route::get('/checkout',[OrderController::class, 'checkoutForm'])->name('checkout.page');

    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.create');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});