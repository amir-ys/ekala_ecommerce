<?php
namespace Modules\Payment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;

Route::group([] , function (){
    Route::get('pay'  ,  [OrderController::class , 'generate'])->name('panel.payment.pay');
});
