<?php

namespace App\Core\Routing;

use App\Core\Request;

class Router
{
    private array $routes;
    private Request $request;
    private ?array $currentRout;

    public function __construct(Route $route, Request $request)
    {
        $this->routes = $route::routes();
        $this->request = $request;
        $this->currentRout = $this->findRoute($this->request);
    }


    private function findRoute(Request $request): ?array
    {
        foreach ($this->routes as $route) {
            if (in_array($request->method(), $route['methods']) && $request->route() == $route['uri']) {
                return $route;
            }
        }
        return null;
    }

    public function run()
    {
    }
}
