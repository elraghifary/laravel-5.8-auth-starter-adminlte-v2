<?php

use App\ModelHasRole;
use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelHasRole::create([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);
    }
}
