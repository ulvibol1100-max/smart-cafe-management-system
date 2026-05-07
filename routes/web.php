<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Models\User;
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
        /** @var User $user */
        $user = auth()->user();
        return $user->is_admin
          ? app(DashboardController::class)->__invoke()
            : redirect()->route('orders.create');
    })->name('dashboard');

    // Staff can create orders and view order history
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::patch('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

        Route::resource('products', ProductController::class)->except('show');
        Route::resource('customers', CustomerController::class)->except('show');
        Route::resource('staff', StaffController::class)->except('show');
    });
}); 
