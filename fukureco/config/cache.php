<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | デフォルトキャッシュ保存場所
    |--------------------------------------------------------------------------
    |
    | このオプションはこのキャッシュライブラリで使用するデフォルトの
    | キャッシュ接続を制御します。この接続はキャッシュ機能にどこへ
    | キャッシュするのか、明白に指定されていない場合に使用されます。
    |
    | Supported: "apc", "array", "database", "file",
    |            "memcached", "redis", "dynamodb"
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | キャッシュ保存場所
    |--------------------------------------------------------------------------
    |
    | ここでアプリケーションの全キャッシュ「保存場所」を定義し、
    | 同時にドライバーを指定します。キャッシュに保存するアイテムのグループ
    | タイプに対し、同じキャッシュドライバーを複数定義することもできます。
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | キャッシュキープレフィックス
    |--------------------------------------------------------------------------
    |
    | APCやMemcachedのようなRAMベースでの保存法を使用する場合、
    | 他のアプリケーションも使用しているかも知れません。衝突を避けるために
    | 全部のキーにプレフィックスをつけた値を指定します。
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache'),

];
