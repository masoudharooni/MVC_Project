<?php

namespace App\Core;

use App\Utilities\Url;

class Router
{
    private array $routes;
    public function __construct()
    {
        $this->routes = [
            '/'             => '/home/index.php',
            '/colors/blue'  => '/colors/blue.php',
            '/colors/red'   => '/colors/red.php',
            '/colors/green' => '/colors/green.php'
        ];
    }

    public function run()
    {
        $currentRout = Url::currentRout();
        foreach ($this->routes as $rout => $view) {
            if ($rout == $currentRout) {
                include BASE_PATH . "views/" . $view;
                die;
            }
        }
        include BASE_PATH . "views/errors/404.php";
    }
}