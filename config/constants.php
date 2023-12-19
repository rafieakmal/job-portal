<?php

use Illuminate\Support\Str;

return [

/*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'whatsapp_api' => [
        'url' => 'http://192.168.10.101:5000/api/wa/send-message',
        'token' => 'testapikey'
    ],

    'email_api' => [
        'url' => 'http://192.168.10.101:7000/api/v1/send-email',
        'token' => 'testapikey'
    ],
];
