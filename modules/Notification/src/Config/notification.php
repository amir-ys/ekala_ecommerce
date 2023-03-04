<?php

return [

    'email' => [

    ],

    'sms' => [
        'default' => [
            'provider' => 'kavenegar',
        ],

        'test_mode' => true,

        'providers' => [
            'kavenegar' => [
                'api_key' => env('KAVENEGAR_API_KEY', 'api_key'),
                'receptor' => env('KAVENEGAR_RECEPTOR'),
                'class' => \Modules\Notification\Services\Providers\KavenegarSmsProvider::class,
            ],
        ]
    ]
];
