<?php

namespace App\Services;

abstract class BaseService
{
    /**
     * @return static
     */
    public static function make($parameters = [])
    {
        return app(static::class, $parameters);
    }   
}
