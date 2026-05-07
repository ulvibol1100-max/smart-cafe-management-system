<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return auth()->user()->is_admin
            ? app(DashboardController::class)()
            : redirect()->route('orders.create');
    })->name('dashboard');
    Route::resource('products', ProductController::class)->except('show');
    Route::resource('customers', CustomerController::class)->except('show');
    Route::patch('orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::resource('orders', OrderController::class);
    Route::resource('staff', StaffController::class)->except('show');
});
