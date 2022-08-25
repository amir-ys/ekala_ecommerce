<?php

namespace Modules\Payment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;
use Modules\Payment\Http\Controllers\PaymentController;

Route::group(['prefix' => 'payments'], function () {
    Route::get('pay', [OrderController::class, 'generate'])->name('panel.payment.pay');
    Route::get('pay/callback', [PaymentController::class, 'callback'])->name('panel.payment.pay.callback');

    //payment
    Route::get('online', [PaymentController::class , 'online'])->name('panel.payments.online');
    Route::get('offline', [PaymentController::class , 'offline'])->name('panel.payments.offline');
    Route::get('cash', [PaymentController::class , 'cash'])->name('panel.payments.cash');
    Route::delete('destroy/{payment}', [PaymentController::class , 'destroy'])->name('panel.payments.destroy');
    Route::get('{payment}/orders', [PaymentController::class , 'getPaymentOrders'])->name('panel.payments.orders.index');
});
