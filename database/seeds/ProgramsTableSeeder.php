<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //-- Random sample
      factory('App\Program', config('kitamatch_config.count_programs'))->create();

      //-- Example sample
    }
}
