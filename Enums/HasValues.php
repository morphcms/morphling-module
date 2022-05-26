<?php

namespace Modules\Morphling\Enums;

use Arr;

trait HasValues
{
    public static function values(): array
    {
        return Arr::pluck(static::cases(), 'value');
    }
}
