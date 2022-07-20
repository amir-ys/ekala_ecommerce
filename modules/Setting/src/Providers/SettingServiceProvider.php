<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Repositories\SettingRepo;

class SettingServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Setting\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Setting');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Setting');
        $this->loadRoutes();

    }

    public function boot()
    {
        $this->app->bind(SettingRepositoryInterface::class, SettingRepo::class);

    }

    private function loadRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/settings_routes.php');
    }

}
