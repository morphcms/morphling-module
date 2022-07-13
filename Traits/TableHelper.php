<?php

namespace Modules\Morphling\Traits;

/**
 * @property string $configPath
 */
trait TableHelper
{
    public static function __callStatic(string $name, array $arguments)
    {
        return static::prefix().collect($arguments)->join('.');
    }

    protected static function prefix(): string
    {
        return config(static::$configPath, '');
    }
}
