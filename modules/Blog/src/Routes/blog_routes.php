<?php

namespace Modules\Blog\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\CategoryController;
use Modules\Blog\Http\Controllers\PostController;

Route::group([
    'prefix' => 'panel/blog'
], function () {
    Route::resource('categories', CategoryController::class)->names('panel.blog.categories')->except('show');
    Route::get('categories/{imageName}/showImage', [CategoryController::class , 'showImage'])->name('panel.blog.categories.showImage');

    Route::resource('posts', PostController::class)->names('panel.blog.posts')->except('show');
    Route::get('posts/{imageName}/showImage', [PostController::class , 'showImage'])->name('panel.blog.posts.showImage');

});

