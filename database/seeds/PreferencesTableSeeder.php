<?php

use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    //create 1/4 times all sample programs
    factory('App\Preference', config('kitamatch_config.count_programs') * (0.25) * config('kitamatch_config.count_applicants'))->create();
  }
}
