<?php

namespace Modules\Notification\Services\Providers\Sms;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class BaseSmsProvider
{
    protected function getApiKey() :string
    {
        return config('notification.sms.providers.' . $this->getDefaultSmsProvider() . '.api_key');
    }

    protected function getDefaultSmsProvider(): mixed
    {
        return config('notification.sms.default.provider');
    }

    private function getDefaultSmsProviderClass(): string
    {
        return config('notification.sms.providers.' . $this->getDefaultSmsProvider() . '.class');
    }
}
