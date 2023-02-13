<?php

namespace Modules\Otp\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Otp\Models\Otp;

/**
  * @method static Otp requestOtp(string $phoneNumber)
 */

class OtpServiceFacades extends Facade
{
    protected static string $key = 'otp.service';

    protected static function getFacadeAccessor(): string
    {
        return self::$key;
    }

    public static function run($class)
    {
        app()->singleton(self::getFacadeAccessor(), $class);
    }

}
