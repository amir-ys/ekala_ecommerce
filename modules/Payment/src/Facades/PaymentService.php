<?php

namespace Modules\Payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void generate(array $amounts)
 */
class PaymentService extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'payment';
    }
}
