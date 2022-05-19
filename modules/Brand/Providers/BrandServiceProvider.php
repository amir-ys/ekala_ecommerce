<?php
namespace Modules\Brand\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Brand\Contracts\BrandRepositoryInterface;
use Modules\Brand\Repositories\BrandRepo;

class BrandServiceProvider extends ServiceProvider
{
    private string $namespace = 'Modules\Brand\Http\Controllers';

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Brand');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang' , 'Brand');
        $this->loadRoutes();

    }

    public function boot()
    {
        $this->app->bind(BrandRepositoryInterface::class , BrandRepo::class);
    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/brands_routes.php');
    }

}
