<?php

namespace Modules\Front\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\Front\Http\Controllers";
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Front');
        $this->loadRoutes();
    }

    public function boot()
    {

    }

    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/front_routes.php');
    }
}
