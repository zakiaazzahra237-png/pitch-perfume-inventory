<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // Akses Admin & Staff
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');

    // Khusus Admin
    Route::middleware('can:admin-only')->group(function () {
        Route::resource('products', ProductController::class);
    });
});

require __DIR__.'/auth.php';