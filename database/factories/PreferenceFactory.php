<?php

use Faker\Generator as Faker;

//Create only preferences for applicants
$factory->define(App\Preference::class, function (Faker $faker) {
  return [
    //sample from the count sample applicants
    'id_from' => $faker->numberBetween($min = 1, $max = config('kitamatch_config.count_applicants')),
    //sample to sample programs
    'id_to' => $faker->unique()->numberBetween($min = 1, $max = config('kitamatch_config.count_programs')),
    'status' => 1,
    'pr_kind' => 1,
    //could compute identical ranks for one applicant, are not sorted like 1,2,3,..; but still works with through the perference order
    'rank' => $faker->numberBetween($min = 1, $max = 20),
  ];
});
