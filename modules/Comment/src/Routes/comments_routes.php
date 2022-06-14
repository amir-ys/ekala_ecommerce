<?php
namespace Modules\Comment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

\Route::group([] , function (){
   Route::resource('comments' , CommentController::class)->names('panel.comments');
});
