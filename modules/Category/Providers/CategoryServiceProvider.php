<?php
namespace Modules\Category\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends  ServiceProvider
{
    private string $namespace = 'Modules\Category\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Category');
        $this->loadRoutes();


    }

    public function boot()
    {

    }

    private function loadRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/categories_routes.php');
    }

}
