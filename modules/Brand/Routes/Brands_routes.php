<?php

use Illuminate\Routing\Router;
use Modules\Brand\Http\Controllers\BrandController;

\Route::group([] , function (Router $router){
    $router->resource('brands' , BrandController::class)->names('panel.brands');
});
