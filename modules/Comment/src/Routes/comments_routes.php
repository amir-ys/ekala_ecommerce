<?php
namespace Modules\Comment\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

\Route::group([] , function (){
   Route::get('comments' , [CommentController::class , 'index'])->name('panel.comments.index');
   Route::get('comments/blog' , [CommentController::class , 'blogCommentsIndex'])->name('panel.comments.blogIndex');
   Route::get('comments/products' , [CommentController::class , 'productCommentsIndex'])->name('panel.comments.productIndex');
   Route::patch('comments/{comment}/approve-status' , [CommentController::class , 'approveStatus'])->name('panel.comments.approveStatus');
   Route::patch('comments/{comment}/reject-status' , [CommentController::class , 'rejectStatus'])->name('panel.comments.rejectStatus');
   Route::get('comments/{comment}/replies/show' , [CommentController::class , 'replyShow'])->name('panel.comments.replies.show');
   Route::any('comments/change-seen-status/{comment?}' , [CommentController::class , 'changeSeenStatus'])->name('panel.comments.changeSeenStatus');
});
   Route::post('comments/store' , [CommentController::class , 'store' ])->name('comments.store');
