<?php

use Faker\Generator as Faker;

$factory->define(App\Guardian::class, function (Faker $faker) {
  return [
    'last_name' => $faker->lastName,
    'first_name' => $faker->firstName,
    'phone' => $faker->e164PhoneNumber,
    'address' => $faker->streetName . " " . $faker->buildingNumber,
    'plz' => $faker->numberBetween($min = 30000, $max = 90000),
    'city' => $faker->city,
    'status' => 52,
    'uid' => factory('App\User')->create()->id,
    #'siblings' => $faker->numberBetween($min = 840, $max = 841),
    #'parental_status' => $faker->numberBetween($min = 820, $max = 824),
    #'volume_of_employment' => $faker->numberBetween($min = 830, $max = 833),
    'siblings' => $faker->numberBetween($min = 840, $max = 840),
    'parental_status' => $faker->numberBetween($min = 820, $max = 820),
    'volume_of_employment' => $faker->numberBetween($min = 830, $max = 830),
  ];
});
