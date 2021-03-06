<?php

use App\Http\Controllers\Api\LectureControllers;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HandbookControllers;
use App\Http\Controllers\Api\ChatController;

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
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('reset', [AuthController::class, 'reset'])->name('reset-password');
        Route::post('change-password', [AuthController::class, 'change_password'])->name('change-password');
        Route::put('me', [AuthController::class, 'update'])->name('profile.update');
        Route::get('me', [AuthController::class, 'me'])->name('profile.me');
        Route::post('me/image', [AuthController::class, 'uploadProfileImage']);
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::post('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend/{id}', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::middleware('auth:api')->group(function () {
        Route::post('user-lectures/{id}', [LectureControllers::class, 'userLectures'])->name('user.lectures');
        Route::post('lecture/{id}', [LectureControllers::class, 'lecture'])->name('lecture');
        Route::get('form-lecture', [LectureControllers::class, 'formLecture'])->name('form.lecture');
        Route::post('form-lecture', [LectureControllers::class, 'createLecture'])->name('create.lecture');

        Route::post('chat', [ChatController::class, 'store'])->name('chat.store');
        Route::get('chat', [ChatController::class, 'chat'])->name('chat');
        Route::get('messages', [ChatController::class, 'messages'])->name('messages');
        Route::post('message', [ChatController::class, 'storeMessage'])->name('chat.store-message');

        Route::group(['prefix' => '/cities'], function () {
            Route::get('/', [HandbookControllers::class, 'getCities']);
            Route::get('/{id}', [HandbookControllers::class, 'city']);
        });

        Route::group(['prefix' => '/universities'], function () {
            Route::get('/', [HandbookControllers::class, 'getUniversities']);
            Route::get('/{id}', [HandbookControllers::class, 'university']);
        });
    });
});
