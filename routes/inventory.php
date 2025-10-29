<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
   Route::get('/dashboard/inventories', [InventoryController::class, 'index'])->name('dashboard.inventories');
    Route::get('/dashboard/inventories/create', [InventoryController::class, 'create'])->name('dashboard.inventories.create');
    Route::post('/dashboard/inventories/store', [InventoryController::class, 'store'])->name('dashboard.inventories.store');
    Route::get('/dashboard/inventories/{id}/edit', [InventoryController::class, 'edit'])->name('dashboard.inventories.edit');
    Route::patch('/dashboard/inventories/{id}/update', [InventoryController::class, 'update'])->name('dashboard.inventories.update');
    Route::delete('/dashboard/inventories/{id}/delete', [InventoryController::class, 'destroy'])->name('dashboard.inventories.delete');

    
});