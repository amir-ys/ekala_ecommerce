<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Contracts\ContactRepositoryInterface;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Models\Setting;
use Modules\Setting\Policies\SettingPolicy;
use Modules\Setting\Repositories\ContactRepo;
use Modules\Setting\Repositories\FaqRepo;
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
        Gate::policy(Setting::class , SettingPolicy::class);
    }

    public function boot()
    {
        $this->app->bind(SettingRepositoryInterface::class, SettingRepo::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepo::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepo::class);

    }

    private function loadRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/settings_routes.php');
    }

}
