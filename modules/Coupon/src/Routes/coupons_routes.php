<?php

namespace Modules\Coupon\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\CouponController;

\Route::group(['prefix' => 'panel'], function () {
    Route::resource('coupons', CouponController::class)
        ->names('panel.coupons')
        ->except('show');
});
