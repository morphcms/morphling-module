<?php

namespace Modules\Morphling\Services;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class BootstrapService
{

    public function __construct(protected array $bootstrappers = [])
    {

    }


    public function boot(): Collection
    {
        return app(Pipeline::class)
            ->send(collect())
            ->through($this->bootstrappers)
            ->via('boot')
            ->thenReturn();
    }
}
