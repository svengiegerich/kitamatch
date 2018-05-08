<?php

use Illuminate\Database\Seeder;

class GuardiansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Guardian', 60)->create();
    }
}
