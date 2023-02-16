<?php

namespace Modules\Notification\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @method static send($phone_number , $text)
 */

class NotificationFacade extends Facade
{
    protected static string $key = 'sms.notification';

    protected static function getFacadeAccessor(): string
    {
        return self::$key;
    }

    public static function run($class)
    {
        app()->singleton(self::$key, $class);
    }

}
