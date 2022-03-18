<?php

namespace Kek\Traits;

trait Singleton
{
    /**
     * @var static
     */
    private static $instance;

    /**
     * @return static
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
