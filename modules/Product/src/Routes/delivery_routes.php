<?php

namespace Modules\Product\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\DeliveryController;

Route::group(['prefix' => 'panel'], function () {
    Route::resource('delivery', DeliveryController::class)->names('panel.delivery');
});


