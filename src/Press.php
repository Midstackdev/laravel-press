<?php

namespace Midstackdev\Press;

class Press
{
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    public function driver()
    {
        $driver = ucfirst(config('press.driver'));

        $class = 'Midstackdev\\Press\\Drivers\\' . $driver . 'Driver';

        return new $class;
    }

    public function path()
    {
        return config('press.path', 'blog');
    } 
}