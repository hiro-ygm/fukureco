<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| コンソールルート
|--------------------------------------------------------------------------
|
| ここでクロージャベースのコンソールコマンドをすべて定義します。
| 各コマンドのIOメソッドにシンプルに関わりあえるアプローチが
| 取れるように、各クロージャはコマンドインスタンスと結合されます。
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
