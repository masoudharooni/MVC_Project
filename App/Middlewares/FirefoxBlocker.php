<?php

namespace App\Middlewares;

use App\Middlewares\Contracts\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class FirefoxBlocker implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isFirefox())
            die("your browser is Firefox and you cannot use our website!");
    }
}
