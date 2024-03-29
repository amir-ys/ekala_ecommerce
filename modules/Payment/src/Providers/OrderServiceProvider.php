<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Repositories\OrderRepo;
use Modules\Payment\Services\OrderService;

class OrderServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\\Payment\\Http\\Controllers";

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Order');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Order');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');


    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind('order_service', OrderService::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepo::class);
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/orders_routes.php');
        }
    }

}
