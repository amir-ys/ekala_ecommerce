<?php

return [
    'default' => [
        'provider' =>  'kavenegar' ,
    ] ,


    'providers' => [
        'kavenegar' => [
            'api_key' => env('KAVENEGAR_API_KEY') ,
            'receptor' => env('KAVENEGAR_RECEPTOR')  ,
            'class' => \Modules\Notification\Services\Providers\KavenegarSmsProvider::class ,
        ] ,
    ]


];
