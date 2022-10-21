<?php

namespace Modules\RolePermissions\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\RolePermissions\Contracts\PermissionRepositoryInterface;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\RolePermissions\Repositories\PermissionRepo;
use Modules\RolePermissions\Repositories\RoleRepo;

class RolePermissionsServiceProvider extends ServiceProvider
{
    protected string $namespace = "Modules\RolePermissions\Http\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'RolePermissions');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang' , 'RolePermissions');
        $this->loadRoutes();

    }

    public function boot()
    {
        $this->app->bind(RoleRepositoryInterface::class , RoleRepo::class);
        $this->app->bind(PermissionRepositoryInterface::class , PermissionRepo::class);
    }

    public function loadRoutes()
    {
        Route::middleware([ 'web' ,'auth' , 'verified'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/role_permissions_routes.php');
    }

}
