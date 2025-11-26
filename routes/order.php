<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');


    Route::get('/checkout',[OrderController::class, 'checkoutForm'])->name('checkout.page');

    // Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.create');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::patch('/orders/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

    Route::post('/create-checkout-session', [OrderController::class, 'placeOrder'])->name('checkout.create');

    Route::get('/checkout/success', [OrderController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [OrderController::class, 'cancel'])->name('checkout.cancel');

    Route::get('/orders/{order}/view', [OrderController::class, 'showOrder'])->name('orders.view');

    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
});