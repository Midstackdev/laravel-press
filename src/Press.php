<?php

namespace Midstackdev\Press;

class Press
{
    public static function configNotPublished()
    {
        return is_null(config('press'));
    }

    public static function driver()
    {
        $driver = ucfirst(config('press.driver'));

        $class = 'Midstackdev\\Press\\Drivers\\' . $driver . 'Driver';

        return new $class;
    }
}