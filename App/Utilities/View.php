<?php

namespace App\Utilities;

class View
{
    /**
     * @param string $pathPattern like this: errors.404
     * @return void
     */
    public static function include(string $pathPattern): void
    {
        $requiredPath = str_replace('.', '/', $pathPattern);
        include_once BASE_PATH . "views/{$requiredPath}.php";
    }
}
