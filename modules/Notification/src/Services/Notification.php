<?php

namespace Modules\Notification\Services;

class Notification
{
    public function send($phone_number, $text): void
    {
        $smsProviderPath = $this->getDefaultSmsProvider();

        $smsProviderObj = new $smsProviderPath();

        $smsProviderObj->send($phone_number , $text);
    }

    public function getDefaultSmsProvider(): string
    {
        $defaultProvider = config('sms.default.provider');
        return config('sms.providers.' . $defaultProvider . '.class');
    }

}
