<?php

namespace Modules\Notification\Services\Providers\Sms;

use Kavenegar\KavenegarApi;
use Modules\Notification\Services\Providers\Sms\Contracts\SmsProviderContract;

class TestModeSmsProvider
{
    public function __invoke(): string
    {
        return 'حالت تست فعال است.';
    }
}
