<?php

namespace Modules\Morphling\Nova\Actions;

use Nwidart\Modules\Facades\Module;

class DeleteModule extends BulkModuleAction
{

    function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        $this->morphling()->uninstall($model);
    }
}
