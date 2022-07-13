<?php

namespace Modules\Morphling\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Morphling\Services\Morphling;

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
