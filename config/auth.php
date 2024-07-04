<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'all_users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'all_users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'all_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\AllUsers::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'all_users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
