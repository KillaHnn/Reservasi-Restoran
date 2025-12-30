<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', fn() => view('dashboard.admin'))->name('admin.dashboard');

        Route::get('/admin/users', [AuthController::class, 'index'])->name('admin.users.index');
        Route::put('/admin/users/{id}', [AuthController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [AuthController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/admin/tables', [TableController::class, 'index'])->name('admin.tables.index');
        Route::get('/admin/tables/create', [TableController::class, 'create'])->name('admin.tables.create');
        Route::post('/admin/tables', [TableController::class, 'store'])->name('admin.tables.store');
        Route::get('/admin/tables/{table}', [TableController::class, 'show'])->name('admin.tables.show');
        Route::get('/admin/tables/{table}/edit', [TableController::class, 'edit'])->name('admin.tables.edit');
        Route::put('/admin/tables/{table}', [TableController::class, 'update'])->name('admin.tables.update');
        Route::delete('/admin/tables/{table}', [TableController::class, 'destroy'])->name('admin.tables.destroy');
    });

    Route::middleware('role:cashier')->group(function () {
        Route::get('/cashier', fn() => view('dashboard.cashier'))->name('cashier.dashboard');
    });

    Route::middleware('role:customer')->group(function () {
        Route::get('/customer', fn() => view('dashboard.customer'))->name('customer.dashboard');
        
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/payments', [PaymentController::class, 'indexCustomer'])->name('payments.index');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
