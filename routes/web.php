<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController ;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes forgot password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
->middleware('guest')
->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
->middleware('guest')
->name('password.email');

// Routes reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
->middleware('guest')
->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
->middleware('guest')
->name('password.update');

//Route Login & register
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login'])
->middleware('throttle:5,1'); // 5 percobaan / 1 menit

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->middleware('throttle:5,1'); // anti spam register
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('admin.dashboard');
    });

Route::middleware(['auth', 'role:cashier'])
    ->prefix('cashier')
    ->group(function () {
        Route::get('/dashboard', fn () => view('cashier.dashboard'))
            ->name('cashier.dashboard');
    });

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->group(function () {
        Route::get('/dashboard', fn () => view('customer.dashboard'))
            ->name('customer.dashboard');
    });