<?php

use App\Core\Routing\Route;

// Route::get('/a', function () {
//     echo "hello | get | /a";
// });
Route::add(['get', 'post'], '/a', function () {
    echo "hello | get | /a";
});

Route::post('/b', function () {
    echo 'hello | post | b';
});

Route::put('/c', function () {
    echo "hello | put | c";
});

Route::delete('/d', function () {
    echo "hello | delete | d";
});

Route::options('/e', function () {
    echo "hello | options | e";
});

Route::patch('/f', function () {
    echo "hello | patch | f";
});
