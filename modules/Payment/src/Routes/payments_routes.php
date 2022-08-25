<?php

namespace Modules\Payment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;
use Modules\Payment\Http\Controllers\PaymentController;

Route::group(['prefix' => 'payments'], function () {
    Route::get('pay', [OrderController::class, 'generate'])->name('panel.payment.pay');
    Route::get('pay/callback', [PaymentController::class, 'callback'])->name('panel.payment.pay.callback');

    //payment
    Route::get('/online', [])->name('panel.payments.online');
});
