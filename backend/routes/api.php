<?php


use App\Http\Controllers\OtpController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });

$version = "v1/";
$url = $version;

Route::group([
    'prefix' => $url . 'auth',
    'middleware' => 'api',
], function ($router) {
    $router->post('/register', [AuthController::class, 'register'])->name('register');
    $router->post('/login', [AuthController::class, 'login'])->name('login');
    $router->post('/login-google', [AuthController::class, 'loginGoogle'])->name('login-google');
    $router->post('/verify-google', [AuthController::class, 'verifyGoogle']);
});

/**
 * FORGOT PASSWORD
 */
Route::group([
    'prefix' => $url,
    'middleware' => 'api',
], function ($router) {
    $router->post('forgot-password/generate-otp', [OtpController::class, 'generateOtp']);
    $router->post('forgot-password/validate-otp', [OtpController::class, 'validateOtp']);
    $router->post('/check-otp', [OtpController::class, 'checkOtp']);
    $router->post('/send-otp', [OtpController::class, 'verificationOtp']);
    $router->post('/reset-password', [PasswordController::class, 'resetPassword']);
});

Route::group([
    'prefix' => $url . 'auth',
    'middleware' => 'jwt.verify',
], function ($router) {
    $router->post('/logout', [AuthController::class, 'logout']);
});

/**
 * PROFILE
 */
Route::group([
    'prefix' => $url . 'user',
    'middleware' => 'jwt.verify'
], function ($router) {
    $router->get('/self', [UserController::class, 'index']);
    // $router->put('/update', [ProfileController::class, 'updateUser']);
    $router->put('/change-password', [PasswordController::class, 'changePassword']);
    // $router->put('/update-fcm-token', [FcmController::class, 'updateFcmToken']);
    $router->get('/', [UserController::class, 'showData']);
    $router->get('/{guid}', [UserController::class, 'getData']);
    $router->put('/', [UserController::class, 'updateData']);
    $router->delete('/{guid}', [UserController::class, 'deleteData']);
    $router->post('/', [UserController::class, 'insertData']);
    $router->post('/sync-google', [AuthController::class, 'syncGoogle']);
});

/**
 * FORM
 */
Route::group([
    'prefix' => $url . 'form',
    'middleware' => 'jwt.verify'
], function ($router) {
    $router->get('/', [FormController::class, 'showData']);
    $router->get('/result/{guid}', [FormController::class, 'result']);
    $router->get('/{guid}', [FormController::class, 'getData']);
    $router->put('/', [FormController::class, 'updateData']);
    $router->delete('/{guid}', [FormController::class, 'deleteData']);
    $router->post('/', [FormController::class, 'insertData']);
});

/**
 * USER FORM
 */
Route::group([
    'prefix' => $url . 'user-form',
    'middleware' => 'jwt.verify'
], function ($router) {
    $router->get('/', [UserFormController::class, 'showData']);
    $router->get('/{guid}', [UserFormController::class, 'getData']);
    $router->put('/', [UserFormController::class, 'updateData']);
    $router->delete('/{guid}', [UserFormController::class, 'deleteData']);
    $router->post('/', [UserFormController::class, 'insertData']);
});
