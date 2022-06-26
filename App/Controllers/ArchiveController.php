<?php

namespace App\Controllers;

use App\Utilities\View;

class ArchiveController
{
    public static function index()
    {
        echo "Hello From '" . self::class . "'";
        View::include('articles.index');
    }
}
