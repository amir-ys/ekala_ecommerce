<?php

namespace Modules\Coupon\Providers;

use Illuminate\Support\ServiceProvider;

class CouponServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

    }

    public function boot()
    {

    }

}
