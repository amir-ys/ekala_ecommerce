<?php

namespace Modules\Payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void generate(array $amounts)
 */
class OrderServiceFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'order_service';
    }
}
