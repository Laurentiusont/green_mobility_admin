<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Maps;
use App\Http\Controllers\dashboard\Merchants;

use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\dashboard\About;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/maps', [Maps::class, 'index'])->name('dashboard-maps');
Route::get('/about-us', [About::class, 'index'])->name('about-us');

// admin section
Route::get('/merchants', [Merchants::class, 'merchants'])->name('merchants');
Route::get('/merchants_locations', [Merchants::class, 'merchantsLocations'])->name('merchants_locations');
Route::get('/parking_lots', [Merchants::class, 'parkingLots'])->name('parking_lots');
Route::get('/users', [Merchants::class, 'users'])->name('users');


// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
