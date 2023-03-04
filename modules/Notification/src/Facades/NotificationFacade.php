<?php

namespace Modules\Notification\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Notification\Services\Providers\Sms\TestModeSmsProvider;
use stdClass;

/**
 * @method static sendSms($phone_number, $text)
 * @method static sendEmail($email,$text)
 */
class NotificationFacade extends Facade
{
    protected static string $key = 'notification';

    protected static function getFacadeAccessor(): string
    {
        return self::$key;
    }

    public static function run($class)
    {
        app()->singleton(self::$key, $class);
    }

}
