<?php

use App\Core\Routing\Route;

Route::get('/', 'HomeController@index');

Route::get('/archive', 'ArchiveController@index');
Route::get('/archive/', 'ArchiveController@index');

Route::get('/archive/articles', 'ArchiveController@articles');
Route::get('/archive/articles/', 'ArchiveController@articles');

Route::get('/archive/products', 'ArchiveController@products');
Route::get('/archive/products/', 'ArchiveController@products');


Route::get('/todo/list/', 'TodoController@list');
Route::get('/todo/list', 'TodoController@list');
