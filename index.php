<?php
# Front-Controller
include "bootstrap/init.php";

use App\Core\Routing\Route;
use App\Core\Routing\Router;


// var_dump(Route::routes());
$router = new Router(new Route, $request);
