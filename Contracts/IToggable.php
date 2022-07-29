<?php

namespace Modules\Morphling\Contracts;

use Illuminate\Database\Query\Builder;

interface IToggable
{
    public function toggle(): bool;
    public function enable(): bool;
    public function disable(): bool;
}
