<?php

namespace App\Controllers;

use App\Utilities\View;

class ArchiveController
{
    public static function index()
    {
        View::include('archives.index');
    }
    public function articles()
    {
        View::include('archives.articles');
    }

    public function products()
    {
        View::include('archives.products');
    }
}
