<?php
function site_url(string $rout)
{
    return "{$_ENV['DOMAIN']}/{$rout}";
}

function asset(string $path): string
{
    return BASE_PATH . "assets/{$path}";
}
