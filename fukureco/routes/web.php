<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Webルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのWebルートを登録できます。"web"ルートは
| ミドルウェアのグループの中へ、RouteServiceProviderによりロード
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/posts','PostController');
Route::get('/hash_tags/{id}/posts','PostController@showByHashTag')->name('hash_tags.posts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
