<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sail HTTPS enabled.
    |--------------------------------------------------------------------------
    |
    | Define if the Sail HTTPS is enabled or not.
    |
    */

    'enabled' => env('SAIL_HTTPS_ENABLED', env('APP_ENV') === 'local'),

    /*
    |--------------------------------------------------------------------------
    | Authorized domains.
    |--------------------------------------------------------------------------
    |
    | Use this to define the domains that are authorized to use Https on
    | your local Sail environment.
    |
    */

    'authorized_domains' => explode(',', env('SAIL_HTTPS_AUTHORIZED_DOMAINS', '') ?: ''),
];
