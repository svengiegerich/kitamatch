<?php

use Illuminate\Database\Seeder;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('codes')->insert([
            'code' => 10,
            'value' => 'not valid',
      ]
    }
}
