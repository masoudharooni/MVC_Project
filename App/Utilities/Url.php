<?php

namespace App\Utilities;

class Url
{
    public static function current(): string
    {
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}
