<?php

namespace App\Middlewares;

use App\Middlewares\Contracts\MiddlewareInterface;
use App\Middlewares\FirefoxBlocker;;
class GlobalMiddleware
{
    private static $globalMiddlewares = [FirefoxBlocker::class];
    public static function get()
    {
        return self::$globalMiddlewares;
    }
    public static function set(string $globMiddlewares)
    {
        self::$globalMiddlewares[] = $globMiddlewares;
    }
}
