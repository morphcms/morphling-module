<?php

namespace Modules\Morphling\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Modules\Morphling\Nova\Resources\Module;

class MorphTool extends Tool
{

    protected static array $resources = [
        Module::class,
    ];

    public function boot()
    {
        Nova::resources(static::$resources);
    }

    public function menu(Request $request)
    {
        return MenuSection::resource(Module::class)
            ->icon('chip')
            ->canSee(fn() => true);
    }
}
