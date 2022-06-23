<?php
# Front-Controller

use App\Utilities\Asset;
use App\Utilities\Url;
use App\Utilities\Lang;

include "bootstrap/init.php";
var_dump(Asset::css('styles.css'));
echo Url::current() . "<hr>";
echo Lang::persianNumber(1234) . "<hr>";
echo Lang::latinNumber("۴") . "<hr>";
$txt = "کرونا در سال 1398 وارد ایران شد.";
echo Lang::persianNumber($txt);
