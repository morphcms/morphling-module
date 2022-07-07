<?php

namespace Modules\Morphling\Traits;

use Illuminate\Support\Str;

/**
 * @property string $configPath
 */
trait TableHelper
{
    public static function __callStatic(string $name, array $arguments)
    {
        return static::prefix() . Str::of($name)->snake() . collect($arguments)->join('.');
    }

    protected static function prefix(): string
    {
        return config(static::$configPath, '');
    }
}
