<?php

namespace Modules\Product\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Observers\ProductObserver;
use Modules\Product\Models\Product;
use Modules\Product\Policies\ProductPolicy;
use Modules\Product\Repositories\ProductRepo;

class ProductServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\Product\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Product');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Product');
        Gate::policy(Product::class, ProductPolicy::class);
    }

    public function boot()
    {
        $this->loadProductRoutes();
        $this->app->bind(ProductRepositoryInterface::class, ProductRepo::class);
    }

    private function loadProductRoutes()
    {
        if (!app()->routesAreCached()) {
            Route::middleware(['web'] + config('core.panel_middlewares'))
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../Routes/products_routes.php');
        }
    }
}
