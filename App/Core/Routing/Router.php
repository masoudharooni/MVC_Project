<?php

namespace App\Core\Routing;

use App\Core\Request;
use App\Exceptions\UndefinedClassException;
use App\Exceptions\UndefinedMethodException;
use App\Middlewares\GlobalMiddleware;
use App\Middlewares\InternetExplorerBlocker;
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
        GlobalMiddleware::set(InternetExplorerBlocker::class);
        $this->runMiddleware(GlobalMiddleware::get());
        $this->runMiddleware($this->currentRout['middleware'] ?? []);
    }


    private function findRoute(Request $request): ?array
    {
        foreach ($this->routes as $route) {
            if (in_array($request->method(), $route['methods']) && $this->isRegexMatched($route)) {
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


    private function runMiddleware(?array $middlewares)
    {
        if (!empty($middlewares) && !is_null($middlewares)) {
            foreach ($middlewares as $middlewareClassName) {
                $middlewareObj = new $middlewareClassName;
                $middlewareObj->handle();
            }
        }
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

    private function isRegexMatched(array $route): bool
    {
        global $request;
        if (preg_match($route['uri'], $this->request->uri(), $matches)) {
            foreach ($matches as $key => $value)
                if (!is_int($key))
                    $request->addRouteParam($key, $value);
            return true;
        }
        return false;
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
            if (!in_array($request->method(), $route['methods']) && $this->isRegexMatched($route))
                return true;
        return false;
    }
}
