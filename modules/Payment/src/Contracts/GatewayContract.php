<?php

namespace Modules\Payment\Contracts;

interface GatewayContract
{
    public function request(string $amount, string $description);

    public function verify($request, $payment);

    public function redirect();

    public function getName();
}








