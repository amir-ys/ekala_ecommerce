<?php
namespace Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    private  string $namespace = "Modules\User\Http\Controllers";
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'User');
        $this->loadUserRoute();
        $this->loadAuthRoute();

    }

    public function boot()
    {

    }

    private function loadUserRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/auth_routes.php');
    }

    private function loadAuthRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/auth_routes.php');
    }
}
