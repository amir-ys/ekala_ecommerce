<?php
namespace Modules\Product\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Repositories\ProductRepo;

class ProductServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\Product\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Product');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang' , 'Product');
        $this->loadRoutes();
    }

    public function boot()
    {
        $this->app->bind(ProductRepositoryInterface::class , ProductRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/products_routes.php');
    }
}