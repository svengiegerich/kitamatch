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
    factory('App\Applicant', config('kitamatch_config.count_applicants'))->create();

    //create super / admin user
    $user = new App\User();
    $user->password = Hash::make('secret');
    $user->email = 'm@zew.de';
    $user->account_type = "5";
    $user->save();
  }
}
