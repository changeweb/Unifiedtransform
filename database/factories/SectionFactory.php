<?php

use Faker\Generator as Faker;

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        'section_number' => $faker->randomElement(['A', 'B','C','D','E','F','G','H','I','J','K','L','M']),
        'room_number' => $faker->randomDigitNotNull,
        'class_id' => $faker->randomElement(App\Myclass::pluck('id')->toArray()),
    ];
});
