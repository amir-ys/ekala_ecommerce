<?php

namespace Modules\AttributeGroup\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Models\AttributeGroup;
use Modules\AttributeGroup\Policies\AttributeGroupPolicy;
use Modules\AttributeGroup\Repositories\AttributeGroupRepo;

class AttributeGroupServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\AttributeGroup\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'AttributeGroup');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'AttributeGroup');
        Gate::policy(AttributeGroup::class, AttributeGroupPolicy::class);
    }

    public function boot()
    {
        $this->loadRoutes();
        app()->bind(AttributeGroupRepositoryInterface::class, AttributeGroupRepo::class);
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/attributeGroups_routes.php');
        }
    }

}
