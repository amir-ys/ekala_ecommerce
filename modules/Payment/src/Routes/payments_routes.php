<?php
namespace Modules\Payment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;
use Modules\Payment\Http\Controllers\TransactionController;

Route::group([] , function (){
    Route::get('pay'  ,  [OrderController::class , 'generate'])->name('panel.payment.pay');
    Route::get('pay/callback'  ,  [TransactionController::class , 'callback'])->name('panel.payment.pay.callback');
});
