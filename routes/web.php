<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Shared Routes (Index only for products)
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    
    // Sales can be accessed by both (or just Kasir/Admin)
    Route::resource('sales', SaleController::class)->only(['index', 'create', 'store']);

    // Admin Specific Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);
        Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store']);
        
        // Product Management (Everything except index/show)
        Route::resource('products', ProductController::class)->except(['index', 'show']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
