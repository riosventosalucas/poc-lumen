<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt', // Especificamos que se usará JWT como driver
            'provider' => 'users', // Define qué provider usar, por ejemplo 'users'
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Define el modelo de usuario
        ],
    ],
];
