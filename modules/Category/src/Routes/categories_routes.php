<?php
namespace Modules\Category\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

\Route::group([] , function (){
   Route::resource('categories' , CategoryController::class)->names('panel.categories');
});
