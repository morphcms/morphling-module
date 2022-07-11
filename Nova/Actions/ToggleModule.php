<?php

namespace Modules\Morphling\Nova\Actions;

use Modules\Morphling\Services\Morphling;
use Nwidart\Modules\Facades\Module;

class ToggleModule extends BulkModuleAction
{


    public function name()
    {
        return __('Enable/Disable Module');
    }


    function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        if ($model->enabled) {
            $this->morphling()->disable($model);
        } else {
            $this->morphling()->enable($model);
        }
    }
}
