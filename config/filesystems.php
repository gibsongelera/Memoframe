<?php

return [
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
        ],
        'cloud' => [
            'driver' => 's3',
            'key' => env('CLOUD_ACCESS_KEY_ID'),
            'secret' => env('CLOUD_ACCESS_KEY_SECRET'),
            'region' => env('CLOUD_DEFAULT_REGION'),
            'bucket' => env('CLOUD_BUCKET'),
            'endpoint' => env('CLOUD_ENDPOINT'),
            'use_path_style_endpoint' => false,
        ],
    ],
];
