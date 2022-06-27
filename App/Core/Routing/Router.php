<?php

namespace App\Core\Routing;

use App\Core\Request;
use App\Exceptions\UndefinedClassException;
use App\Exceptions\UndefinedMethodException;
use App\Utilities\View;

class Router
{
    private array $routes;
    private Request $request;
    private ?array $currentRout;
    private const BASE_NAMESPACE = "App\\Controllers\\";
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
        #  405: invalid request method
        if ($this->invalidRequestMethod($this->request)) {
            $this->dispatch405();
        }
        # 404: uri is not exists
        if (is_null($this->currentRout)) {
            $this->dispatch404();
        }
        $this->dispatch($this->currentRout);
    }

    private function dispatch($route)
    {
        $action = $route['action'];
        # action : null
        if (is_null($action) || empty($action))
            return;
        # action : callable
        if (is_callable($action))
            $action();
        # action : controller@method
        if (is_string($action))
            $action = explode('@', $action);
        # action : ['controller', 'method']
        if (is_array($action)) {
            list($controller, $method) = $action;
            $className = self::BASE_NAMESPACE . $controller;
            if (!class_exists($className))
                throw new UndefinedClassException("Class '{$className}' is not exist!");

            $controller = new $className();

            if (!method_exists($className, $method))
                throw new UndefinedMethodException("'{$method}' Mehod is not exist in the '{$className}' class!");
            $controller->{$method}();
        }
    }

    private function dispatch405()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
        View::include('errors.405');
        die;
    }
    private function dispatch404()
    {
        header("HTTP/1.0 404 Not Found");
        View::include('errors.404');
        die;
    }

    private function invalidRequestMethod(Request $request): bool
    {
        foreach ($this->routes as $route)
            if (!in_array($request->method(), $route['methods']) && $request->route() == $route['uri'])
                return true;
        return false;
    }
}