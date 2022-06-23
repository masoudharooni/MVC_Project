<?php
# Front-Controller

use App\Core\Router;

include "bootstrap/init.php";

$router = new Router;
$router->run();
