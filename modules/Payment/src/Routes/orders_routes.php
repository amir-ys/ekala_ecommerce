<?php


use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\OrderController;

Route::group(['prefix' => 'orders'], function () {

    Route::get('/', [OrderController::class , 'index'])->name('panel.orders.index');
    Route::get('sending', [OrderController::class , 'sending'])->name('panel.orders.sending.index');
    Route::get('unpaid', [OrderController::class , 'unpaid'])->name('panel.orders.unpaid.index');
    Route::get('canceled', [OrderController::class , 'canceled'])->name('panel.orders.canceled.index');
    Route::get('returned', [OrderController::class , 'returned'])->name('panel.orders.returned.index');
    Route::get('{order}/change-status', [OrderController::class , 'changeStatusPage'])->name('panel.orders.changeStatus.page');
    Route::patch('{order}/change-status', [OrderController::class , 'changeStatus'])->name('panel.orders.changeStatus');
    Route::get('{order}/show', [OrderController::class , 'show'])->name('panel.orders.show');
    Route::get('{order}/details', [OrderController::class , 'details'])->name('panel.orders.details');
});
