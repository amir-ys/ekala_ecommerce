<?php

namespace Modules\Notification\Services\Providers\Contracts;

interface SmsProviderContract
{
    public function send(string $phone_number ,string $text);
}
