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
    public static function asset($path, $secured = false) {
        return self::urlGenerator()->asset($path, $secured);
    }

}