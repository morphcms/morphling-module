<?php

namespace Modules\Morphling\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Morphling\Models\Module as ModuleModel;
use Modules\Morphling\Services\Morphling;
use Nwidart\Modules\Facades\Module;

class MorphlingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app(Morphling::class)->syncModules();
    }
}
