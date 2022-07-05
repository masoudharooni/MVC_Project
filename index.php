<?php
# Front-Controller
include "bootstrap/init.php";

use App\Core\Routing\Route;
use App\Core\Routing\Router;

$router = new Router(new Route, $request);
$router->run();
