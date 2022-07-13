<?php

namespace Modules\Morphling\Nova\Actions;

class DeleteModule extends BulkModuleAction
{
    public function moduleAction(\Modules\Morphling\Models\Module $model)
    {
        $this->morphling()->uninstall($model);
    }
}
