<?php

namespace Modules\Morphling\Utils;

class DataAggregator
{
    public static function event(string|object $event, array $mergeAfter = [], array $mergeBefore = []): \Illuminate\Support\Collection
    {
        return collect([
            ...$mergeBefore,
            ...event($event),
            ...$mergeAfter,
        ])
            ->filter() // Filter out empty values
            ->flatten();
    }
}
