<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/inventories', function () {
        return 'dashboard.inventories';
    })->name('dashboard.inventories');

    Route::get('/dashboard/users', function () {
        return 'dashboard.users';
    })->name('dashboard.users');

    Route::get('/dashboard/products', function () {
        return 'dashboard.products';
    })->name('dashboard.products');

    
});

Route::middleware('auth')->group(function () {
 Route::get('/setting', function () {
        return 'setting';
    })->name('setting');

    Route::get('/orders', function () {
        return 'dashboard.orders';
    })->name('orders');

});



require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
