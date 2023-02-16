<?php

namespace Modules\Notification\Services\Providers\Contracts;

interface SmsProviderContract
{
    public function send($phone_number , $text);
}
