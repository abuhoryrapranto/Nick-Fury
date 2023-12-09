<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class, '__invoke')->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

Route::prefix('v1')->group(function () {

    Route::controller(AuthController::class)->prefix('auth')->group(function() {
        Route::post('register', 'register');
        Route::post('email-login', 'emailLogin');
    });
});

