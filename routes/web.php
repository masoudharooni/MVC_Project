<?php

use App\Core\Routing\Route;

Route::get('/', 'HomeController@index');
Route::get('/archive', 'ArchiveController@index');
