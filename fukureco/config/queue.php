<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | LaravelキューAPIは同じAPIを使用して様々なバックエンドが使用できるよう
    | 統一されたAPIをサポートしています。ここではデフォルトキュードライバーを
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | キュー接続
    |--------------------------------------------------------------------------
    |
    | ここでアプリケーションが使用するそれぞれのサーバーに対する接続情報を
    | 設定します。それぞれのバックエンドのデフォルト接続はLaravelに最初から
    | 設定されています。自由に追加してください。
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'your-queue-name'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | 失敗したキュージョブ
    |--------------------------------------------------------------------------
    |
    | このオプションでは失敗したキュージョブをログする振る舞いを設定します。
    | どのデータベースとテーブルを保存に使用するかをコントロールできます。
    | お好きなデータベース／テーブルに変更して下さい。
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
