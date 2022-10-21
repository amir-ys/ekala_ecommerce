<?php
namespace Modules\RolePermissions\Routes;

use Illuminate\Support\Facades\Route;
use Modules\RolePermissions\Http\Controllers\RoleController;

Route::prefix('panel')->group(function (){
    Route::resource('roles' , RoleController::class)->names('panel.roles');
});
