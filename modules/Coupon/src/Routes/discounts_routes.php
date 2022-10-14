<?php

namespace Modules\Coupon\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\CommonDiscountController;

\Route::group([], function () {
    Route::resource('common-common-discounts', CommonDiscountController::class)
        ->names('panel.commonDiscounts')
        ->except('show');
});
