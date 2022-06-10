<?php
namespace Modules\Product\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductAttributeController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductImageController;

Route::group(['prefix' => 'panel'] , function (){
    //product
   Route::resource('products' , ProductController::class)->names('panel.products');

   //product images
   Route::get('products/{product}/images' , [ProductImageController::class , 'show'])->name('panel.products.images.show') ;
   Route::get('products/images/{image}/display' , [ProductImageController::class , 'display'])->name('panel.products.images.display');
   Route::delete('products/{product}/image/{image}/delete' , [ProductImageController::class , 'deleteImage'])->name('panel.products.images.delete');
   Route::delete('products/{product}/image/delete-all' , [ProductImageController::class , 'deleteAllImages'])->name('panel.products.images.deleteAll');
   Route::post('products/{product}/image/upload' , [ProductImageController::class , 'upload'])->name('panel.products.images.upload');

   //product attributes
   Route::get('products/{product}/attributes' , [ProductAttributeController::class , 'show'])->name('panel.products.attributes.show') ;
   Route::post('products/{product}/attribute-vale/save' , [ProductAttributeController::class , 'saveAttributeValue'])->name('panel.products.attributes.save') ;

});
