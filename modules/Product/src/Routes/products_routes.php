<?php
namespace Modules\Product\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::group([] , function (){
   Route::resource('products' , ProductController::class)->names('panel.products') ;
});
