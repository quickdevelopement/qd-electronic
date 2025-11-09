<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/users', function () {
        return 'dashboard.users';
    })->name('dashboard.users');


    
});

Route::middleware('auth')->group(function () {
 Route::get('/setting', function () {
        return 'setting';
    })->name('setting');

  

});



require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/product.php';
require __DIR__.'/inventory.php';
require __DIR__.'/cart.php';
require __DIR__.'/order.php';
