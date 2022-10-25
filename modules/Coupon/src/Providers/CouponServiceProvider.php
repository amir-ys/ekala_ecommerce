<?php

namespace Modules\Coupon\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Coupon\Contracts\CouponRepositoryInterface;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Policies\CouponPolicy;
use Modules\Coupon\Repositories\CouponRepo;

class CouponServiceProvider extends ServiceProvider
{
    protected $namespace = "Modules\\Coupon\\Http\\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Coupon');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Coupon');
        $this->defineRoutes();
        Gate::policy(Coupon::class , CouponPolicy::class);
    }

    public function boot()
    {
        $this->app->bind(CouponRepositoryInterface::class, CouponRepo::class);

    }

    private function defineRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/coupons_routes.php');
    }

}
