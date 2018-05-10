<?php

use Illuminate\Database\Seeder;

class ApplicantsTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    factory('App\Applicant', config('constants.count_applicants'))->create();
  }
}
