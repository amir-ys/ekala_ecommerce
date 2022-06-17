<?php
namespace Modules\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\CategoryController;
use Modules\Front\Http\Controllers\HomeController;
use Modules\Front\Http\Controllers\ImageController;
use Modules\Front\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductImageController;

Route::group([] , function (){
   Route::get('/' , [ HomeController::class  , 'index'])->name('front.home');
   Route::get('image/{image}/display' , [ProductImageController::class , 'display'])->name('image.display');
   Route::get('product/{product:slug}' , [ProductController::class , 'show'])->name('front.product.details');
   Route::get('category/{category:slug}' , [CategoryController::class , 'products'])->name('front.products-category.details');

   Route::get('products' , [ProductController::class , 'list'])->name('front.products.list');
   Route::get('products/{product:slug}' , [ProductController::class , 'show'])->name('front.products.details');

   //image
    Route::get('front/image/{dir}/{image}' , [ImageController::class , 'show'])->name('front.images.show');
});
