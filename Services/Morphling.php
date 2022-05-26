<?php

namespace Modules\Morphling\Services;

use Illuminate\Support\Facades\URL;

class Morphling
{
    public static function clientUrl($path = '/'): string
    {
        return URL::format(config('frontend.client_url'), $path);
    }
}
