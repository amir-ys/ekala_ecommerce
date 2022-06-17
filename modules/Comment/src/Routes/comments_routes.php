<?php
namespace Modules\Comment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

\Route::group([] , function (){
   Route::get('comments' , [CommentController::class , 'index'])->name('panel.comments.index');
});
   Route::post('comments/store' , [CommentController::class , 'store' ])->name('comments.store');
