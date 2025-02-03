<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\{RegisterController, LoginController};

// Public routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
