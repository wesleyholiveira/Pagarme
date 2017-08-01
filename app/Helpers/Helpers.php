<?php

namespace App\Helpers;

class Helpers
{
    /**
     * @return \Laravel\Lumen\Routing\UrlGenerator
     */
    public static function urlGenerator()
    {
        return new \Laravel\Lumen\Routing\UrlGenerator(app());
    }

    /**
     * @param      $path
     * @param bool $secured
     * @return mixed
     */
    public static function asset($path, $secured = false)
    {
        return self::urlGenerator()->asset($path, $secured);
    }

    /**
     * @param float $number
     * @return string
     */
    public static function moneyFormat(float $number) : string
    {
        return number_format($number, 2, ',', '.');
    }

}