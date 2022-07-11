<?php

namespace Modules\Morphling\Contracts;

use Closure;
use Illuminate\Support\Collection;
use Modules\Morphling\Events\FrontendBootstrap;

interface Bootstrapper
{
    public function handle(FrontendBootstrap $event): mixed;
}
