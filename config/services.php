<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '724420766524762',
        'client_secret' => 'd8295a4713da4fdf6e772ccf048b7226',
        'redirect' => 'https://timviecsieunhanh.vn/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '606104324634-7uc1k0d7d0qgm5pl09tmvra0fqkptiip.apps.googleusercontent.com',
        'client_secret' => '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',
        // 'redirect' => 'http://127.0.0.1:8000/handleGoogleCallback',
        'redirect' => 'https://timviecsieunhanh.vn/handleGoogleCallback',
    ],
];


