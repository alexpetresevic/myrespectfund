<?php

return [
    'enabled'       => env('WEPAY_ENABLED', false),
    'environment'   => env('WEPAY_ENV', false),
    'client_id'     => env('WEPAY_CLIENT_ID', false),
    'account_id'     => env('WEPAY_ACCOUNT_ID', false),
    'client_secret' => env('WEPAY_CLIENT_SECRET', false),
    'access_token'  => env('WEPAY_ACCESS_TOKEN', false),
];
