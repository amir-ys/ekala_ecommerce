<?php
namespace Modules\Brand\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Brand\Http\Controllers';

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Brand');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutes()
;    }

    public function boot()
    {

    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/Brands_routes.php');
    }

}
