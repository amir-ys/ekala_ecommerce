<?php

namespace Modules\Category\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Category\Models\Category;
use Modules\Category\Policies\CategoryPolicy;
use Modules\Category\Repositories\CategoryRepo;

class CategoryServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Category\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Category');
        Gate::policy(Category::class, CategoryPolicy::class);


    }

    public function boot()
    {
        $this->loadRoutes();
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepo::class);
    }

    private function loadRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/categories_routes.php');
        }
    }

}
