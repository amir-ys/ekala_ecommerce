<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\User\Http\Controllers\Auth\NewPasswordController;
use Modules\User\Http\Controllers\Auth\PasswordResetLinkController;
use Modules\User\Http\Controllers\Auth\RegisteredUserController;
use Modules\User\Http\Controllers\Auth\EmailVerificationController;

Route::middleware('guest')->group(function () {
    //register
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    //login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    //forget password
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('email/verify', [EmailVerificationController::class, 'showForm'])->name('verification.showForm');

    Route::post('email/verify', [EmailVerificationController::class, 'checkCode'])->middleware(['throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/resend', [EmailVerificationController::class, 'resend'])
        ->middleware('emailThrottle')
        ->name('verification.resend');

    //logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
