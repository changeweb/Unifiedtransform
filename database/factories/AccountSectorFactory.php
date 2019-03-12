<?php

use Faker\Generator as Faker;

$factory->define(App\AccountSector::class, function (Faker $faker) {
    return [
      'name' => $faker->catchPhrase,
      'type' => $faker->randomElement(['income','expense']),
      'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
    ];
});
