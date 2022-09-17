<?php
namespace Modules\User\Routes;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::group([] ,  function (Router $router){
    //panel
    $router->get('users' , [UserController::class , 'index'])->name('panel.users.index');
    $router->get('users/create' , [UserController::class , 'create'])->name('panel.users.create');
    $router->post('users' , [UserController::class , 'store'])->name('panel.users.store');
    $router->get('users/{user}/edit' , [UserController::class , 'edit'])->name('panel.users.edit');
    $router->patch('users/{user}' , [UserController::class , 'update'])->name('panel.users.update');
    $router->delete('users/{user}' , [UserController::class , 'destroy'])->name('panel.users.destroy');
    $router->get('user/{name}/profile' , [UserController::class , 'showImage'])->name('panel.users.profile.show');

    //front
    Route::get('users/find-city-by-province' , [UserController::class , 'findCityByProvince'])->name('panel.users.findCityByProvince');
    Route::post('users/address/store' , [UserController::class , 'UserAddressStore'])->name('panel.users.address.store');
    Route::any('users/address/{id}/destroy' , [UserController::class , 'UserAddressDelete'])->name('panel.users.address.destroy');
    Route::any('users/address/{id}/changeStatus' , [UserController::class , 'UserAddressChangeStatus'])->name('panel.users.address.changeStatus');
    Route::any('users/address/{id}/find' , [UserController::class , 'UserAddressFind'])->name('panel.users.address.find');

});
