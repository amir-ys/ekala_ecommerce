<?php

namespace Modules\Payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void generate(array $amounts)
 */
class PaymentServiceFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'paymentService';
    }
}
