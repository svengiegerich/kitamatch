<?php

use Faker\Generator as Faker;

$factory->define(App\Applicant::class, function (Faker $faker) {
  $random = rand(0, 1);
  if ($random <= 0.5) {
    $gender = "M";
  } else {
    $gender = "W";
  }

  return [
    'last_name' => $faker->lastName,
    'first_name' => $faker->firstName,
    'status' => 22,
    'gid' => factory('App\Guardian')->create()->id,
    'gender' => $gender,
    'birthday' => date($format = '2014-01-01', $max = '2016-12-31'),
  ];
});
