<?php

namespace Modules\RolePermissions\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\RolePermissions\Contracts\PermissionRepositoryInterface;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\RolePermissions\Models\Permission;
use Modules\RolePermissions\Models\Role;
use Modules\RolePermissions\Policies\RolePermissionPolicy;
use Modules\RolePermissions\Repositories\PermissionRepo;
use Modules\RolePermissions\Repositories\RoleRepo;
use Modules\User\Models\User;

class RolePermissionsServiceProvider extends ServiceProvider
{
    protected string $namespace = "Modules\RolePermissions\Http\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermissions');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'RolePermissions');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Gate::policy(Role::class, RolePermissionPolicy::class);
        Gate::before(function (User $user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });

    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(RoleRepositoryInterface::class, RoleRepo::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepo::class);
    }

    public function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/role_permissions_routes.php');
        }
    }

}
