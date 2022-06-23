<?php

namespace App\Utilities;

class Lang
{
    private static $fa_numbers = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'];
    private static $en_numbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

    public static function persianNumber($number): string
    {
        return str_replace(self::$en_numbers, self::$fa_numbers, (string)$number);
    }
    public static function latinNumber($number): string
    {
        return str_replace(self::$fa_numbers, self::$en_numbers,  (string)$number);
    }
}
