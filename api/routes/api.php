<?php

use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/status/{serviceName?}', [StatusController::class, 'status']);
Route::post('/mail', [StatusController::class, 'mail']);
Route::post('/broadcast', [StatusController::class, 'event']);

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [RegistrationController::class, 'register']);
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('login');
    });

    Route::post('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});
