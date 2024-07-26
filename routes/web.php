<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/set-session', [SessionController::class, 'setLogin'])->name('session.login');
Route::post('/register-session', [SessionController::class, 'setRegister'])->name('session.register');
Route::get('/clear-session', [App\Http\Controllers\SessionController::class, 'clearSession'])->name('session.clear');

Route::group([
    'middleware' => 'auth.guest',
], function ($router) {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/login-password', [AuthController::class, 'indexPassword'])->name('login.password');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/verify', [AuthController::class, 'verifyEmail'])->name('verify');
    Route::get('password/reset/email', [App\Http\Controllers\PasswordController::class, 'emailOTP'])->name('password.request');
    Route::get('password/reset/password', [App\Http\Controllers\PasswordController::class, 'inputReset'])->name('password.update');
});

Route::group([
    'middleware' => 'auth.token',
], function ($router) {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/testlomba', [DashboardController::class, 'lomba'])->name('lomba');

    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user-profile');

    Route::get('auth/google/sync', [GoogleController::class, 'syncToGoogle'])->name('google-sync');
    Route::get('auth/google/call-back/sync', [GoogleController::class, 'handleCallbackSync']);

    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::get('/result', [FormController::class, 'result'])->name('result');
    Route::get('/about', [DashboardController::class, 'about'])->name('about');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleController::class, 'handleCallback']);

Route::get('auth/google/verify', [GoogleController::class, 'verifyToGoogle'])->name('google-verify');
Route::get('auth/google/call-back/verify', [GoogleController::class, 'handleCallbackVerify']);
Route::get('auth/otp/verify', [AuthController::class, 'verify'])->name('otp-verification');
Route::get('auth/otp/resend', [AuthController::class, 'resendOtp'])->name('otp-resend');
Route::get('verify/{guid}/{otp}', [AuthController::class, 'checkOtp'])->name('check-otp');
