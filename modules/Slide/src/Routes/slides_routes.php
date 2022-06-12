<?php
namespace Modules\Slide\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Slide\Http\Controllers\SlideController;

Route::group([] , function (){
   Route::resource('slides' , SlideController::class)->names('panel.slides');
   Route::get('slide/image/{image}' , [SlideController::class , 'showImage'])->name('panel.slides.image');
});

