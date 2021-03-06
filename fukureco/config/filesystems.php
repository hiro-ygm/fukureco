<?php

return [

    /*
    |--------------------------------------------------------------------------
    | デフォルトファイルシステムディスク
    |--------------------------------------------------------------------------
    |
    | フレームワークにより使用されるべき、デフォルトのファイルシステムを
    | ここに指定してください。"local"ドライバーの他に、様々なクラウド
    | ベースのディスクを選択することができます。どんどん保存しましょう！
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | デフォルトクラウドファイルシステムディスク
    |--------------------------------------------------------------------------
    |
    | 多くのアプリケーションが、ローカルとクラウドの両方にファイルを保存します。
    | このため、ここでデフォルトの「クラウド」ドライバーを指定できます。
    | このドライバーはコンテナの中で、クラウドディスク実装として結合されます。
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | ファイルシステムディスク
    |--------------------------------------------------------------------------
    |
    | ここで好きなだけ、ファイルシステム「ディスク」を設定できます。
    | 同じドライバーに複数のディスクを設定することも可能です。指定が必要な
    | オプションの例として、各ドライバーのデフォルトが用意されています。
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
