<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'amazon' => [
        'clientPrivateKey' => env('AWS_CLIENT_SECRET_KEY'),
        'serverPublicKey' => env('AWS_SERVER_PUBLIC_KEY'),
        'serverPrivateKey' => env('AWS_SERVER_PRIVATE_KEY'),
        'expectedBucketName' => env('S3_BUCKET_NAME'),
        'expectedHostName' => env('S3_HOST_NAME'),
        'expectedMaxSize' => env('S3_MAX_FILE_SIZE',null),
        'expectedBucketRegion' => env('S3_BUCKET_REGION','us-east-1'),
        'expectedBucketVersion' => env('S3_BUCKET_VERSION','2006-03-01'),
    ],

];
