<?php

namespace Modules\Morphling\Nova\Actions;

use Nwidart\Modules\Facades\Module;

class UpdateModule extends BulkModuleAction
{

    function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        $this->morphling()->update($model);
    }
}
