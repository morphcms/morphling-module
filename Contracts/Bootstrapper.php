<?php

namespace Modules\Morphling\Contracts;

use Closure;
use Illuminate\Support\Collection;

interface Bootstrapper
{
    public function boot(Collection $data, Closure $next): Collection;
}
