<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get("email/verify/{id}/{hash}", [VerificationController::class, '__invoke'])
        ->middleware(["signed", "throttle:6,1"])
        ->name("verification.verify");

    Route::get('user', [UserController::class, 'user'])->name('user');
    Route::get('user/sessions', [UserController::class, 'sessions'])->name('user.sessions');
});

