<?php
namespace Modules\User\Routes;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AdminController;
use Modules\User\Http\Controllers\UserController;

Route::group(['prefix' => 'panel'] ,  function (Router $router){
    //users
    $router->get('users' , [UserController::class , 'index'])->name('panel.users.index');
    $router->get('users/create' , [UserController::class , 'create'])->name('panel.users.create');
    $router->post('users' , [UserController::class , 'store'])->name('panel.users.store');
    $router->get('users/{user}/edit' , [UserController::class , 'edit'])->name('panel.users.edit');
    $router->patch('users/{user}' , [UserController::class , 'update'])->name('panel.users.update');
    $router->delete('users/{user}' , [UserController::class , 'destroy'])->name('panel.users.destroy');
    $router->get('user/{name}/profile' , [UserController::class , 'showImage'])->name('panel.users.profile.show');

    //admins
    $router->get('admins' , [AdminController::class , 'index'])->name('panel.admins.index');
    $router->get('admins/create' , [AdminController::class , 'create'])->name('panel.admins.create');
    $router->post('admins' , [AdminController::class , 'store'])->name('panel.admins.store');
    $router->get('admins/{admin}/edit' , [AdminController::class , 'edit'])->name('panel.admins.edit');
    $router->patch('admins/{admin}' , [AdminController::class , 'update'])->name('panel.admins.update');
    $router->delete('admins/{admin}' , [AdminController::class , 'destroy'])->name('panel.admins.destroy');
    $router->get('admin/{name}/profile' , [AdminController::class , 'showImage'])->name('panel.admins.profile.show');

    //front
    Route::get('users/find-city-by-province' , [UserController::class , 'findCityByProvince'])->name('panel.users.findCityByProvince');
    Route::post('users/address/store' , [UserController::class , 'UserAddressStore'])->name('panel.users.address.store');
    Route::any('users/address/{id}/destroy' , [UserController::class , 'UserAddressDelete'])->name('panel.users.address.destroy');
    Route::any('users/address/{id}/changeStatus' , [UserController::class , 'UserAddressChangeStatus'])->name('panel.users.address.changeStatus');
    Route::any('users/address/{id}/find' , [UserController::class , 'UserAddressFind'])->name('panel.users.address.find');

});
