<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sync Targets
    |--------------------------------------------------------------------------
    | Menentukan aplikasi mana yang jadi target sync untuk setiap entity_type,
    | sesuai dokumen bagian 4 (Source of Truth / Data Master).
    */
    'sync_targets' => [
        'customer'     => ['billing', 'pulseboard', 'wifikula'],
        'subscription' => ['billing', 'pulseboard', 'wifikula'],
        'invoice'      => ['management', 'wifikula'],
        'payment'      => ['management', 'wifikula', 'pulseboard'],
        'pppoe'        => ['management', 'wifikula'],
        'ticket'       => ['wifikula', 'pulseboard'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Aplikasi Target
    |--------------------------------------------------------------------------
    | Base URL dan API key untuk masing-masing aplikasi yang dituju
    | oleh Sync Worker lewat Adapter.
    */
    'apps' => [
        'management' => [
            'base_url' => env('MANAGEMENT_BASE_URL', 'http://127.0.0.1:8001'),
            'api_key'  => env('MANAGEMENT_API_KEY', 'dummy-key-management'),
        ],
        'billing' => [
            'base_url' => env('BILLING_BASE_URL', 'http://127.0.0.1:8002'),
            'api_key'  => env('BILLING_API_KEY', 'dummy-key-billing'),
        ],
        'pulseboard' => [
            'base_url' => env('PULSEBOARD_BASE_URL', 'http://127.0.0.1:8003'),
            'api_key'  => env('PULSEBOARD_API_KEY', 'dummy-key-pulseboard'),
        ],
        'wifikula' => [
            'base_url' => env('WIFIKULA_BASE_URL', 'http://127.0.0.1:8004'),
            'api_key'  => env('WIFIKULA_API_KEY', 'dummy-key-wifikula'),
        ],
    ],

];