<?php
# Front-Controller

use App\Core\Request;
use App\Core\Router;

include "bootstrap/init.php";


$request = new Request();
var_dump($request->getIp());

// $request->redirect('/colors/red');
// $router = new Router;
// $router->run();  
var_dump($request->getInput('proId'));
// var_dump($request->isset('proId'));
