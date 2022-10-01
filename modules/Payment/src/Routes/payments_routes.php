<?php

namespace Modules\Payment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;
use Modules\Payment\Http\Controllers\PaymentController;

Route::group(['prefix' => 'payments'], function () {
    //payment
    Route::get('/', [PaymentController::class, 'index'])->name('panel.payments.index');
    Route::get('online', [PaymentController::class, 'online'])->name('panel.payments.online');
    Route::get('offline', [PaymentController::class, 'offline'])->name('panel.payments.offline');
    Route::delete('destroy/{payment}', [PaymentController::class, 'destroy'])->name('panel.payments.destroy');
    Route::get('{payment}/orders', [PaymentController::class, 'getPaymentOrders'])->name('panel.payments.orders.index');
});
