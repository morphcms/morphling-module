<?php

namespace Modules\Morphling\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Modules\Morphling\Events\RegisterModulesNovaTools;
use Modules\Morphling\Models\Module as ModuleEntity;
use Modules\Morphling\Nova\MorphTool;
use Nwidart\Modules\Facades\Module as ModuleActivator;
use Nwidart\Modules\Process\Installer;

class Morphling
{
    public static function clientUrl($path = '/'): string
    {
        return URL::format(config('frontend.client_url'), $path);
    }

    /**
     *  Collect all module tools.
     *
     * @param  array  $tools
     * @return array
     */
    public static function getNovaTools(array $tools = []): array
    {
        return collect([
            ...event(new RegisterModulesNovaTools()),
            MorphTool::make(),
        ])
            ->filter() // Filter out empty values
            ->flatten()
            ->merge($tools)
            ->toArray();
    }

    public function fetchModulesFromRepository()
    {
        // TODO: Implement
        // - https://github.com/composer/satis
        //  - https://alexvanderbist.com/2021/setting-up-and-securing-a-private-composer-repository/
        // - https://composer.github.io/satis/using
        // TODO: Fetch them from a repository
        return collect([
            'morphcms/reviews-module' => 'Reviews',
            'morphcms/arcanist-module' => 'Arcanist',
            'morphcms/blog-module' => 'Blog',
            'morphcms/shop-module' => 'Shop',
            'morphcms/acl-module' => 'Access Control List (ACL)',
            'morphcms/collection-module' => 'Collections',
            'morphcms/places-module' => 'Places',
            'morphcms/settings-module' => 'Settings',
            'morphcms/vue-slider-module' => 'Vue Slider',
            'morphcms/page-builder-module' => 'Page Builder',
            'morphcms/command-palette-module' => 'Command Palette',
            'morphcms/campaigns-module' => 'Campaigns',
        ])->sort()->toArray();
    }

    /**
     * @param  string  $package
     * @return void
     *
     * @throws \Exception
     */
    public function install(string $package, string $version = 'dev-main', string $type = 'github', bool $tree = false)
    {
        $installer = new Installer($package, $version, $type, $tree);
        $installer->setRepository(resolve('modules'));

        //TODO: Add the repository to composer first if doesn't exist or do some other stuff needed;
        return DB::transaction(function () use ($package, $installer) {
            // TODO: Check requirements before, maybe install all the other packages first?
            //ModuleActivator::install($package, 'dev-main');
            $installer->run();
            $module = ModuleActivator::findOrFail(static::moduleNameFromPackage($package));
            $this->syncModule($module);
        });
    }

    private static function moduleNameFromPackage($package)
    {
        $parts = explode('/', $package);

        return Str::studly(Str::replaceLast('-module', '', end($parts)));
    }

    public function uninstall(ModuleEntity $model)
    {
        return DB::transaction(function () use ($model) {
            // Prevents this to accidentally delete it when developing the module with symlinks.
            // We will disable the module and delete the model entity.

            if (app()->environment('local')) {
                ModuleActivator::disable($model->name);
            } else {
                ModuleActivator::delete($model->name);
            }

            $model->delete();
        });
    }

    public function enable(ModuleEntity $model)
    {
        return DB::transaction(function () use ($model) {
            ModuleActivator::enable($model->name);
            $model->update(['enabled' => true]);
        });
    }

    public function disable(ModuleEntity $model)
    {
        return DB::transaction(function () use ($model) {
            ModuleActivator::disable($model->name);
            $model->update(['enabled' => false]);
        });
    }

    public function update(ModuleEntity $model)
    {
        return DB::transaction(function () use ($model) {
            ModuleActivator::update($model->name);
            $this->syncModule($model->name);
        });
    }

    public function syncModules(): void
    {
        $modules = ModuleActivator::all();

        foreach ($modules as $module) {
            $this->syncModule($module);
        }
    }

    public function syncModule(\Nwidart\Modules\Laravel\Module|string $module)
    {
        if (is_string($module)) {
            $module = ModuleActivator::findOrFail($module);
        }

        return ModuleEntity::firstOrNew([
            'name' => $module->getName(),
        ], [
            'title' => $module->get('title', $module->getName()),
            'alias' => $module->getAlias(),
            'description' => $module->getDescription(),
            'keywords' => $module->get('keywords'),
            'priority' => $module->getPriority(),
            'enabled' => $module->isEnabled(),
            'requirements' => $module->getRequires(),
            'version' => $module->get('version'),
            'minimumCoreVersion' => $module->get('minimumCoreVersion'),
            'author' => $module->get('author', 'Unknown'),
        ])->save();
    }
}
