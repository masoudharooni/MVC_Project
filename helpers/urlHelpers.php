<?php
function site_url(string $rout)
{
    return "{$_ENV['DOMAIN']}/{$rout}";
}
