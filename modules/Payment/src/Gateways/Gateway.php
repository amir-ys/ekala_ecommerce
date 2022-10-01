<?php

namespace Modules\Payment\Gateways;

class Gateway
{
    public function callbackUrl(): string
    {
        return route('front.payment.callback');
    }
}
