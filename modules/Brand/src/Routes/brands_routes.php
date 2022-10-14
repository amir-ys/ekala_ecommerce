<?php
namespace Modules\Brand\Routes;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\Brand\Http\Controllers\BrandController;

Route::group([] , function (Router $router){
    $router->resource('brands' , BrandController::class)->names('panel.brands')
        ->except('show' , 'create');
});
