<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Payment;
use Modules\Payment\Repositories\PaymentRepo;
use Modules\Payment\Services\Payment\OfflinePaymentService;
use Modules\Payment\Services\Payment\OnlinePaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    private $namespace = "Modules\\Payment\\Http\\Controllers";

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Payment');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'Payment');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../Config/payment.php', 'payment');
        $this->loadRoutes();


    }

    public function boot()
    {
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepo::class);

        $this->app->bind( 'Payment_service', function (){

            if (session()->get('payment_type') == Payment::PAYMENT_TYPE_ONLINE){
                return new OnlinePaymentService();
            }else if(session()->get('payment_type') == Payment::PAYMENT_TYPE_OFFLINE){
                return new OfflinePaymentService();
            }

        });

        //todo payment class
        app()->singleton(Gateway::class, function () {
            return new  \Modules\Payment\Gateways\Zarinpal\ZarinpalAdaptor();
        });
    }

    private function loadRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/payments_routes.php');
    }

}
