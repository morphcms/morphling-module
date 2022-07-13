<?php

namespace Modules\Morphling\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Modules\Morphling\Services\Morphling;

abstract class BulkModuleAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $affected = [];

        foreach ($models as $model) {
            try {
                $this->moduleAction($model);
                $affected[] = $model->name;
            } catch (\Exception $exception) {
                Log::error($exception->getMessage(), [
                    'stacktrace' => $exception->getTraceAsString(),
                ]);
            }
        }

        $countAffected = count($affected);
        $total = $models->count();

        return Action::message($this->successMessage($countAffected, $total));
    }

    abstract public function moduleAction(\Modules\Morphling\Models\Module $model);

    protected function successMessage($affected, $total): string
    {
        return "{$affected} modules affected out of {$total}.";
    }

    protected function morphling(): Morphling
    {
        return app(Morphling::class);
    }
}
