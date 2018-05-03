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
    'capacity' => $faker->numberBetween($min = 3, $max = 20),
    'p_kind' => $p_kind,
    'coordination' => $coordination,
    'siblings' => $faker->numberBetween($min = 840, $max = 841),
    'parental_status' => $faker->numberBetween($min = 820, $max = 824),
    'volume_of_employment' => $faker->numberBetween($min = 830, $max = 833),
  ];
});
