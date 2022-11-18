<?php
use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('front.cart.index');
Route::get('/cart/add', [CartController::class, 'add'])->name('front.cart.add');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('front.cart.clear');
Route::get('/cart/{id}/remove', [CartController::class, 'remove'])->name('front.cart.remove');
Route::get('/cart/update', [CartController::class, 'update'])->name('front.cart.update');
