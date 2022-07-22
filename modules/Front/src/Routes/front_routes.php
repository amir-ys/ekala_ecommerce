<?php
namespace Modules\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\CartController;
use Modules\Front\Http\Controllers\CategoryController;
use Modules\Front\Http\Controllers\CheckoutController;
use Modules\Front\Http\Controllers\CompareController;
use Modules\Front\Http\Controllers\CouponController;
use Modules\Front\Http\Controllers\HomeController;
use Modules\Front\Http\Controllers\ImageController;
use Modules\Front\Http\Controllers\ProductController;
use Modules\Front\Http\Controllers\SiteInfoController;
use Modules\Front\Http\Controllers\UserController;
use Modules\Product\Http\Controllers\ProductImageController;

Route::group([ 'middleware' => 'auth' ] ,  function (){
    //user-profile
    Route::get('/user/profile/personal-info' , [UserController::class , 'personalInfo'])->name('front.user.personalInfo.index');
    Route::get('/user/profile/wishlists' , [UserController::class , 'wishlists'])->name('front.user.wishlists.index');
    Route::get('/user/profile/orders' , [UserController::class , 'orders'])->name('front.user.orders.index');
    Route::get('/user/profile/addresses' , [UserController::class , 'addresses'])->name('front.user.addresses.index');
});

Route::group([] , function (){
   Route::get('/' , [ HomeController::class  , 'index'])->name('front.home');
   Route::get('image/{image}/display' , [ProductImageController::class , 'display'])->name('image.display');
   Route::get('product/{product:slug}' , [ProductController::class , 'show'])->name('front.product.details');
   Route::get('category/{category:slug}' , [CategoryController::class , 'products'])->name('front.products-category.details');

   Route::get('products' , [ProductController::class , 'list'])->name('front.products.list');
   Route::get('products/{product:slug}' , [ProductController::class , 'show'])->name('front.products.details');

   //image
    Route::get('front/image/{dir}/{image}' , [ImageController::class , 'show'])->name('front.images.show');

    //compare
    Route::get('/compare-list' , [CompareController::class , 'index'])->name('front.compare.index');
    Route::get('/compare/{product}/add' , [CompareController::class , 'add'])->name('front.compare.add');
    Route::get('/compare/{product}/remove' , [CompareController::class , 'remove'])->name('front.compare.remove');

    //cart
    Route::get('/cart' , [CartController::class , 'index'])->name('front.cart.index');
    Route::get('/cart/add' , [CartController::class , 'add'])->name('front.cart.add');
    Route::get('/cart/clear' , [CartController::class , 'clear'])->name('front.cart.clear');
    Route::get('/cart/{id}/remove' , [CartController::class , 'remove'])->name('front.cart.remove');
    Route::get('/cart/update' , [CartController::class , 'update'])->name('front.cart.update');

    //coupon
    Route::get('/coupon/check' , [CouponController::class , 'check'])->name('front.coupon.check');

    //checkout
    Route::get('/checkout' , [CheckoutController::class , 'showPage'])->name('front.checkout.page');
    Route::post('/checkout' , [CheckoutController::class , 'checkout'])->name('front.checkout.check');

    //about-us
    Route::get('/about-us' , [SiteInfoController::class , 'showAboutPage'])->name('front.aboutUs.show');
    Route::get('/contact-us' , [SiteInfoController::class , 'showContactPage'])->name('front.contactUs.show');

    //faqs
    Route::get('/faqs' , [SiteInfoController::class , 'showFaqPage'])->name('front.faqs.show');

});
