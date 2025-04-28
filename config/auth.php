<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'user' => [
            'driver' => 'session',
            'provider' => 'users',
            'session' => 'user_session', // Add this
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
            'session' => 'admin_session', // Add this
        ],

        'vendor' => [
            'driver' => 'session',
            'provider' => 'users',
            'session' => 'vendor_session', // optional
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
