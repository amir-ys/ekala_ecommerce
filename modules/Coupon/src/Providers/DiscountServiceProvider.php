<?php

namespace Modules\Coupon\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Coupon\Contracts\CommonDiscountRepositoryInterface;
use Modules\Coupon\Repositories\CommonDiscountRepo;

class DiscountServiceProvider extends ServiceProvider
{
    protected $namespace = "Modules\\Coupon\\Http\\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Discount');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Discount');
    }

    public function boot()
    {
        $this->defineRoutes();
        $this->app->bind(CommonDiscountRepositoryInterface::class, CommonDiscountRepo::class);

    }

    private function defineRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/discounts_routes.php');
        }
    }

}
