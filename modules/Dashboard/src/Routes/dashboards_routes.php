<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;

Route::group( [], function($router) {
    $router->get('/panel/dashboard', [ DashboardController::class, 'index'])->name('panel.home');
});


