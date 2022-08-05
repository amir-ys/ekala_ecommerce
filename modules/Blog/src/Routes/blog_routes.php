<?php

namespace Modules\Blog\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\CategoryController;
use Modules\Blog\Http\Controllers\PostController;

Route::group([
    'prefix' => 'blog'
], function () {
    Route::resource('categories', CategoryController::class)->names('panel.blog.categories');
    Route::get('categories/{imageName}/showImage', [CategoryController::class , 'showImage'])->name('panel.blog.categories.showImage');

    Route::resource('posts', PostController::class)->names('panel.blog.posts');
});
