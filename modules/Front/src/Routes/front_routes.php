<?php

namespace Modules\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\BlogController;
use Modules\Front\Http\Controllers\CartController;
use Modules\Front\Http\Controllers\CheckoutController;
use Modules\Front\Http\Controllers\CouponController;
use Modules\Front\Http\Controllers\HomeController;
use Modules\Front\Http\Controllers\PaymentController;
use Modules\Front\Http\Controllers\ProductController;
use Modules\Front\Http\Controllers\ProfileController;
use Modules\Front\Http\Controllers\SiteInfoController;
use Modules\Front\Http\Controllers\SlideController;
use Modules\Front\Http\Controllers\UserController;
use Modules\Front\Http\Controllers\WishlistController;
use Modules\Product\Http\Controllers\ProductImageController;

Route::group(['middleware' => 'auth'], function () {
    //user-profile
    Route::get('/user/profile/personal-info', [UserController::class, 'personalInfo'])->name('front.user.personalInfo.index');
    Route::get('/user/profile/wishlists', [UserController::class, 'wishlists'])->name('front.user.wishlists.index');
    Route::get('/user/profile/orders', [UserController::class, 'orders'])->name('front.user.orders.index');
    Route::get('/user/profile/addresses', [UserController::class, 'addresses'])->name('front.user.addresses.index');
    Route::patch('user/profile/{id}/update', [ProfileController::class, 'edit'])->name('front.profile.edit');
    Route::get('user/profile/{id}/image/display', [ProfileController::class, 'displayImage'])->name('front.profile.image.display');


    Route::group(['middleware' => ['filling_cart', 'profile_complete']], function () {

        //checkout
        Route::get('/checkout/save-address', [CheckoutController::class, 'addressPage'])->name('front.checkout.addressPage');
        Route::post('/checkout/save-address', [CheckoutController::class, 'addressSave'])->name('front.checkout.saveAddress');
        Route::get('/checkout', [CheckoutController::class, 'checkoutPage'])->name('front.checkout.page');
        Route::post('/checkout/save', [CheckoutController::class, 'checkout'])->name('front.checkout.check');

        //payment
        Route::get('pay', [PaymentController::class, 'generate'])->name('front.payment.pay');
        Route::get('pay/callback', [PaymentController::class, 'callback'])->name('front.payment.callback');
    });

    Route::get('/profile/complete/view', [ProfileController::class, 'profileCompletePage'])->name('front.checkout.profile.complete.page');
    Route::post('/profile/complete', [ProfileController::class, 'profileCompleteSave'])->name('front.checkout.profile.complete.save');

    //coupon discount
    Route::post('/coupon/check', [CouponController::class, 'check'])->name('front.coupon.check');


});

Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('front.home');
    Route::get('image/{product}/{image}/display', [ProductImageController::class, 'display'])->name('image.display');
    Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('front.product.details');
    Route::get('products/category/{category:slug}', [ProductController::class, 'categoryProducts'])->name('front.categoryProducts.show');

    Route::get('products', [ProductController::class, 'list'])->name('front.products.list');
    Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('front.products.details');

    //image
    Route::get('front/image/{slide}/show', [SlideController::class, 'showImage'])->name('front.images.slide.show');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('front.cart.index');
    Route::get('/cart/add', [CartController::class, 'add'])->name('front.cart.add');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('front.cart.clear');
    Route::get('/cart/{id}/remove', [CartController::class, 'remove'])->name('front.cart.remove');
    Route::get('/cart/update', [CartController::class, 'update'])->name('front.cart.update');


    //about-us
    Route::get('/about-us', [SiteInfoController::class, 'showAboutPage'])->name('front.aboutUs.show');

    //contact-us
    Route::get('/contact-us', [SiteInfoController::class, 'showContactPage'])->name('front.contactUs.show');

    //faqs
    Route::get('/faqs', [SiteInfoController::class, 'showFaqPage'])->name('front.faqs.show');


    Route::prefix('blog')->controller(BlogController::class)->group(function () {
        Route::get('/', 'index')->name('front.blog.index');
        Route::get('/{post:slug}', 'postDetails')->name('front.blog.showPost');
        Route::get('/category/{category:slug}', 'postCategory')->name('front.blog.postCategory');
        Route::get('/tag/{tag}', 'postTags')->name('front.blog.postTags');
        Route::get('image/{image}/display', 'showImage')->name('front.blog.image.show');
    });
});

//wishlist
Route::post('products/{product}/add-or-remove-from-wishlist', [WishlistController::class, 'addOrRemove'])->name('products.wishlist.add')->middleware(['auth']);
Route::get('products/wishlist/check-user-is-login', [WishlistController::class, 'checkUserIsLogin'])->name('products.wishlist.checkUserIsLogin')
    ->middleware(['guest'])->withoutMiddleware(['auth']);
