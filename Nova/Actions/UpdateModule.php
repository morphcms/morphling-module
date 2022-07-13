<?php

namespace Modules\Morphling\Nova\Actions;

class UpdateModule extends BulkModuleAction
{
    public function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        $this->morphling()->update($model);
    }
}
