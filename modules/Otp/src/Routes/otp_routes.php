<?php

namespace Modules\Otp\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Otp\Http\Controllers\AuthenticateOtpController;

Route::prefix('login')->group(function () {
    Route::get('mobile', [AuthenticateOtpController::class, 'showLoginForm'])->name('front.otp.showLoginForm');
    Route::post('mobile', [AuthenticateOtpController::class, 'requestOtp'])->name('front.otp.request');
    Route::get('confirm', [AuthenticateOtpController::class, 'showConfirmForm'])->name('front.otp.showConfirmForm');
    Route::post('confirm', [AuthenticateOtpController::class, 'confirmOtp'])->name('front.otp.confirm');
    Route::get('register-completion', [AuthenticateOtpController::class, 'showRegisterCompletionForm'])->name('front.otp.showRegisterCompletionForm');
    Route::post('register-completion', [AuthenticateOtpController::class, 'registerCompletion'])->name('front.otp.registerCompletion');
});


