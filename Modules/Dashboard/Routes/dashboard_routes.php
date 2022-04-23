<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashbaord\Http\Controllers\DashboardController;

Route::group(['middleware' => [ /* 'auth', 'verified' */ ]
], function($router) {
    $router->get('/home', [ DashboardController::class, 'index'])->name('panel.home');
});


