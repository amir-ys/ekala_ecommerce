<?php

namespace Modules\Otp\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Otp\Contracts\OtpRepositoryInterface;
use Modules\Otp\Facades\OtpServiceFacades;
use Modules\Otp\Repositories\OtpRepo;
use Modules\Otp\Services\OtpService;

class OtpServiceProvider extends ServiceProvider
{
    protected string  $namespace = "Modules\\Otp\\Http\\Controllers";
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Otp');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ .  '/../Config/otp.php' , 'otp');
        $this->loadRoutes();
    }

    public function boot()
    {
        OtpServiceFacades::run(OtpService::class);
        $this->app->singleton(OtpRepositoryInterface::class , OtpRepo::class);
    }

    public function loadRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group( __DIR__ . "/../Routes/otp_routes.php");
    }
}
