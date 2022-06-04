<?php
namespace Modules\Dashboard\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\Dashboard\Http\Controllers';

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
        $this->loadRoutes();


    }

    public function boot()
    {

    }

    public function loadRoutes()
    {
        Route::middleware(['web' , 'auth' , 'verified'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/dashboards_routes.php');
    }
}
