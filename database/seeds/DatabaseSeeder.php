<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    // Disable all mass assignment restrictions
    Model::unguard();

    $this->call(ApplicantsTableSeeder::class);

    $this->call(ProgramTableSeeder::class);

    $this->call(ProvidersTableSeeder::class);
    // Re enable all mass assignment restrictions
    Model::reguard();

  }
}
