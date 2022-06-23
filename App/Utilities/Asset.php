<?php

namespace App\Utilities;

class Asset
{
    public static function get(string $rout): string
    {
        return "{$_ENV['DOMAIN']}/assets/{$rout}";
    }

    public static function __callStatic($method, $arguments)
    {
        $pathFile = "{$_ENV['BASE_PATH']}/assets/{$method}/{$arguments[0]}";
        return (file_exists($pathFile) ? self::get("{$method}/{$arguments[0]}") : null);
    }
}
