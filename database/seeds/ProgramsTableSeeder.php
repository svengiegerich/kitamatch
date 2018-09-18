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

      //-- Example sample (make sure count is same as in config!)
      /*$program = new App\Program();
      $program->name = "Sonnenschein";
      $program->capacity = 5;
      $program->p_kind = 2;
      $program->coordiantion = 1;
      $program->status = 12;
      $program->uid =
      $program->save();*/
    }
}
