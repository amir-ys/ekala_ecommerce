<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\TransactionRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Repositories\OrderRepo;
use Modules\Payment\Repositories\TransactionRepo;
use Modules\Payment\Services\Payment;

class PaymentServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\\Payment\\Http\\Controllers";

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../Config/payment.php', 'payment');
        $this->loadRoutes();


    }

    public function boot()
    {
        $this->app->bind('payment', Payment::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepo::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepo::class);

        app()->singleton(Gateway::class, function () {
            $paymentMethod = cache()->get('payment_method');
            $gatewayMethods = array_keys(config('payment'));
            foreach ($gatewayMethods as $gatewayMethod) {
                if ($paymentMethod == $gatewayMethod) {
                    $className = config('payment.' . $gatewayMethod . '.class');
                    return new $className();
                }
            }
        });
    }

    private function loadRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/payments_routes.php');
    }

}
