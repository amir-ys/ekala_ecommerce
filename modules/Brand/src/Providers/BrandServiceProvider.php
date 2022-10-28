<?php

namespace Modules\Brand\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Brand\Models\Brand;
use Modules\Brand\Policies\BrandPolicy;
use Modules\Brand\Repositories\BrandRepo;

class BrandServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Brand\Http\Controllers';

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Brand');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Brand');
        Gate::policy(Brand::class, BrandPolicy::class);

    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(BrandRepositoryInterface::class, BrandRepo::class);
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/brands_routes.php');
        }
    }

}
