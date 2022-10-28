<?php

namespace Modules\Attribute\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Policies\AttributePolicy;
use Modules\Attribute\Repositories\AttributeRepo;

class AttributeServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Attribute\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Attribute');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Attribute');
        Gate::policy(Attribute::class, AttributePolicy::class);

    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepo::class);

    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/attributes_routes.php');
        }
    }

}
