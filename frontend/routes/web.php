<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmbedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BerkembangController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HighIncomeController;
use App\Http\Controllers\LowAndMiddleIncomeController;
use App\Http\Controllers\LowerMiddleIncomeController;
use App\Http\Controllers\LowIncomeController;
use App\Http\Controllers\MajuController;
use App\Http\Controllers\MiddleIncomeController;
use App\Http\Controllers\MiskinController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\UpperMiddleIncomeController;
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
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/choose-verify', [AuthController::class, 'chooseVerify'])->name('choose-verify');
    Route::get('password/reset/email', [App\Http\Controllers\PasswordController::class, 'emailOTP'])->name('password.request');
    Route::get('password/reset/password', [App\Http\Controllers\PasswordController::class, 'inputReset'])->name('password.update');
});

Route::group([
    'middleware' => 'auth.token',
], function ($router) {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user-profile');
    Route::get('/embed', [EmbedController::class, 'index'])->name('embed');
    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::get('/form/result/{guid}', [FormController::class, 'result'])->name('form-result');

    Route::get('/highincome', [HighIncomeController::class, 'index'])->name('highincome');
    Route::get('/uppermiddleincome', [UpperMiddleIncomeController::class, 'index'])->name('uppermiddleincome');
    Route::get('/lowandmiddleincome', [LowAndMiddleIncomeController::class, 'index'])->name('lowandmiddleincome');
    Route::get('/middleincome', [MiddleIncomeController::class, 'index'])->name('middleincome');
    Route::get('/lowermiddleincome', [LowerMiddleIncomeController::class, 'index'])->name('lowermiddleincome');
    Route::get('/lowincome', [LowIncomeController::class, 'index'])->name('lowincome');

    Route::get('/reward', [RewardController::class, 'index'])->name('reward');
    Route::get('/selesai', [SelesaiController::class, 'index'])->name('selesai');
    Route::get('auth/google/sync', [GoogleController::class, 'syncToGoogle'])->name('google-sync');
    Route::get('auth/google/call-back/sync', [GoogleController::class, 'handleCallbackSync']);
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleController::class, 'handleCallback']);

Route::get('auth/google/verify', [GoogleController::class, 'verifyToGoogle'])->name('google-verify');
Route::get('auth/google/call-back/verify', [GoogleController::class, 'handleCallbackVerify']);
Route::get('auth/otp/verify', [AuthController::class, 'verify'])->name('otp-verification');
Route::get('auth/otp/resend', [AuthController::class, 'resendOtp'])->name('otp-resend');
Route::get('verify/{guid}/{otp}', [AuthController::class, 'checkOtp'])->name('check-otp');


