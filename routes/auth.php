<?php

use App\Http\Controllers\Auth\KYGAuthenticatedSessionController;
use App\Http\Controllers\Auth\KYGConfirmablePasswordController;
use App\Http\Controllers\Auth\KYGEmailVerificationNotificationController;
use App\Http\Controllers\Auth\KYGEmailVerificationPromptController;
use App\Http\Controllers\Auth\KYGNewPasswordController;
use App\Http\Controllers\Auth\KYGPasswordController;
use App\Http\Controllers\Auth\KYGPasswordResetLinkController;
use App\Http\Controllers\Auth\KYGRegisteredUserController;
use App\Http\Controllers\Auth\KYGVerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [KYGRegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [KYGRegisteredUserController::class, 'store']);

    Route::get('login', [KYGAuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [KYGAuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [KYGPasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [KYGPasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [KYGNewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [KYGNewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', KYGEmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', KYGVerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [KYGEmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [KYGConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [KYGConfirmablePasswordController::class, 'store']);

    Route::put('password', [KYGPasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [KYGAuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
