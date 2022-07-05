<?php
# Front-Controller
include "bootstrap/init.php";

use App\Core\Routing\Route;
use App\Core\Routing\Router;
use App\Models\User;

// $router = new Router(new Route, $request);
// $router->run();

$user = new User();
// for ($i = 0; $i < 20; $i++) {
//     $user->create([
//         'name'      => 'masoudharooni' . rand(1, 1000),
//         'email'     => 'masoudharooni@gmail.com' . rand(1, 1000),
//         'password'  => 'masoud' . rand(1, 1000)
//     ]);
// }
var_dump($user->delete(['id[>]' => 5]));
