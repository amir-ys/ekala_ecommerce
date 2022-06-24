<?php
namespace Modules\User\Routes;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::group([] ,  function (Router $router){
    $router->get('users' , [UserController::class , 'index'])->name('panel.users.index');
    $router->get('users/{user}/edit' , [UserController::class , 'edit'])->name('panel.users.edit');
    $router->patch('users/{user}' , [UserController::class , 'update'])->name('panel.users.update');
    $router->get('user/{name}/profile' , [UserController::class , 'showImage'])->name('panel.users.profile.show');
});
