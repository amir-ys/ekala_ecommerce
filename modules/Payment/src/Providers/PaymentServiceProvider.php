<?php
namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\\Payment\\Http\\Controllers";

    public function register()
    {
        $this->loadRoutes();

    }

    public function boot()
    {

    }

    private function loadRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/payments_routes.php');
    }

}
