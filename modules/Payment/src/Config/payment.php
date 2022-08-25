<?php


return [
    'zarinpal' => [
        'status' => true ,
        'name' => 'درگاه پرداخت زرین پال',
        'class' => \Modules\Payment\Gateways\Zarinpal\ZarinpalAdaptor::class,
        'merchant' => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
        'callback_request_name' => 'Authority'
    ],
    'pay' => [
        'status' => false ,
        'name' => 'درگاه پرداخت پی',
        'class' => \Modules\Payment\Gateways\Pay\PayAdaptor::class,
        'merchant' => 'test',
        'callback_request_name' => 'token'
    ],
];
