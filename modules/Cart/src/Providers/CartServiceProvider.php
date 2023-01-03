<?php

namespace Modules\Cart\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Cart\Services\DarryCartService;

class CartServiceProvider extends ServiceProvider
{
    protected string $namespace = "Modules\src\Http\Controllers";

    public function register()
    {
    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind('cart_service' , DarryCartService::class);
    }

    public function loadRoutes()
    {
       if (! app()->routesAreCached()){
           Route::middleware(['web'])
               ->namespace($this->namespace)
               ->group(__DIR__ . '/../Routes/cart_routes.php');
       }
    }
}
