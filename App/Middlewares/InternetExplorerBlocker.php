<?php

namespace App\Middlewares;

use App\Middlewares\Contracts\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class InternetExplorerBlocker implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isIE())
            die("Your browser is InternetExplor and you cannot use our website!");
    }
}
