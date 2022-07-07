<?php

namespace Modules\Morphling\Bootstrappers;

use Illuminate\Support\Collection;
use Modules\Morphling\Contracts\Bootstrapper;
use Modules\Morphling\Services\BootstrapService;

class MorphlingBootstrapper implements Bootstrapper
{

    public function boot(Collection $data, \Closure $next): Collection
    {
       $data->put('morphling', 'ok');

       return $next($data);
    }
}
