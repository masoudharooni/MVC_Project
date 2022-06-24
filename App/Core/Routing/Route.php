<?php

namespace App\Core\Routing;

class Route
{
    private static array $HTTP_VERBS = ['get', 'post', 'put', 'patch', 'delete', 'options'];
    private static array $routes = [];

    /**
     * To add a rout
     *
     * @param array|string $methods
     * @param string $uri
     * @param [type] $action
     * @return void
     */
    public static function add(array|string $methods, string $uri, $action = null): void
    {
        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods' => $methods, 'uri' => $uri, 'action' => $action];
    }

    /**
     * To add a rout with HTTP verbs name
     * @param string $method
     * @param array $arguments  
     * @return void  
     */

    public static function __callStatic(string $method, array $arguments): void
    {
        if (in_array($method, self::$HTTP_VERBS))
            self::add($method, $arguments[0], isset($arguments[1]) ? $arguments[1] : null);
    }


    public static function routes(): array
    {
        return self::$routes;
    }
}
