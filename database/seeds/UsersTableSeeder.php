<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', config('kitamatch_config.count_users'))->create();
        DB::table('users')->insert([
          'email' => "m@zew.de",
          'password' => bcrypt('secret'),
          'account_type' => 5
        ]);
    }
}
