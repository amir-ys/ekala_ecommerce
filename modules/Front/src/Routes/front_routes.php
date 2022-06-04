<?php
namespace Modules\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\HomeController;

Route::group([] , function (){
   Route::get('/' , [ HomeController::class  , 'index'])->name('front.home');
});
