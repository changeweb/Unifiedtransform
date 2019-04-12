<?php

use Faker\Generator as Faker;

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        'section_number' => $faker->randomElement(['A', 'B','C','D','E','F','G','H','I','J','K','L','M']),
        'room_number' => $faker->randomDigitNotNull,
        'class_id' => function () use ($faker) {
          if(App\Myclass::count() == 0)
            return factory(App\Myclass::class)->create()->id;
          else {
            return $faker->randomElement(App\Myclass::pluck('id')->toArray());
          }
        },
    ];
});
