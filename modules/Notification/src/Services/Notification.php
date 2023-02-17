<?php

namespace Modules\Notification\Services;

class Notification
{
    public function send(string $phone_number,string $text): void
    {
        $smsProviderClass = $this->getDefaultSmsProviderClass();

        $smsProviderObj = new $smsProviderClass();

        $smsProviderObj->send($phone_number , $text);
    }

    public function getDefaultSmsProviderClass(): string
    {
        $defaultProvider = config('sms.default.provider');
        return config('sms.providers.' . $defaultProvider . '.class');
    }

}
