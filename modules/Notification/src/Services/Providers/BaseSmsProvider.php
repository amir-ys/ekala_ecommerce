<?php

namespace Modules\Notification\Services\Providers;

class BaseSmsProvider
{
    protected function getApiKey() :string
    {
        $defaultProvider = config('sms.default.provider');
        return config('sms.providers.' . $defaultProvider . '.api_key');
    }
}
