<?php

namespace Modules\Morphling\Nova\Actions;

class ToggleModule extends BulkModuleAction
{
    public function name()
    {
        return __('Enable/Disable Module');
    }

    public function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        if ($model->enabled) {
            $this->morphling()->disable($model);
        } else {
            $this->morphling()->enable($model);
        }
    }
}
