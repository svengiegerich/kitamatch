<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
  return [
    'name' => $faker->company,
    'phone' => $faker->e164PhoneNumber,
    'address' => $faker->streetName . " " . $faker->buildingNumber,
    'plz' => $faker->postcode,
    'city' => $faker->city,
    'status' => 61,
    'uid' => factory('App\User')->create()->id,
  ];
});
