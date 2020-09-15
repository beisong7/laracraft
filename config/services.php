<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'rave' => [
        'public' => env('RAVE_PUBLIC_KEY'),
        'secret' => env('RAVE_SECRET_KEY'),
        'encryption' => env('RAVE_ENCRYPTION_KEY'),
        'environment' => $raveEnvironment = env('RAVE_ENVIRONMENT', 'sandbox'), // 'sandbox', 'live'

        'url' => $raveUrl = $raveEnvironment === 'sandbox'
            ? env('RAVE_SANDBOX_URL', 'https://ravesandboxapi.flutterwave.com')
            : env('RAVE_LIVE_URL', 'https://api.ravepay.co'),

        'resource_url' => $raveUrl . '/flwv3-pug/getpaidx/api',
        'webhook_secret_hash' => $raveUrl . '/flwv3-pug/getpaidx/api',

    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

];
