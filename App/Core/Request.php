<?php

namespace App\Core;

use App\Exceptions\UndefinedMethodException;

class Request
{
    private $params;
    private $method;
    private $agent;
    private $ip;
    private $route;
    public function __construct()
    {
        $this->params = $_REQUEST;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->route = strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function __call($methodName, $arguments)
    {
        return (property_exists($this, $methodName) ? $this->$methodName :
            throw new UndefinedMethodException("Method '{$methodName}' is not exist!"));
    }

    public function input(string $key): ?string
    {
        return $this->params[$key] ?? null;
    }

    public function __get($name)
    {
        return !property_exists($this, $name) ? $this->input($name) : null;
    }

    public function isset($key): bool
    {
        return isset($this->params[$key]);
    }

    public function redirect(string $route)
    {
        header("Location:" . $_ENV['DOMAIN'] . "{$route}");
    }
}
