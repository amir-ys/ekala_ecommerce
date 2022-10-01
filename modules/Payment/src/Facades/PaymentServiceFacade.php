<?php

namespace Modules\Payment\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentServiceFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'Payment_service';
    }
}
