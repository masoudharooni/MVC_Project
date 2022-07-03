<?php

use App\Core\Routing\Route;
use App\Middlewares\FirefoxBlocker;
use App\Middlewares\InternetExplorBlocker;

Route::get('/', 'HomeController@index');

Route::get('/posts/{post_id}');

Route::get('/archive', 'ArchiveController@index');
Route::get('/archive/', 'ArchiveController@index');

Route::get('/archive/articles', 'ArchiveController@articles');
Route::get('/archive/articles/', 'ArchiveController@articles');

Route::get('/archive/products', 'ArchiveController@products');
Route::get('/archive/products/', 'ArchiveController@products');

Route::get('/todo/list/', 'TodoController@list');

Route::get('/todo/list', 'TodoController@list', [FirefoxBlocker::class, InternetExplorBlocker::class]);
