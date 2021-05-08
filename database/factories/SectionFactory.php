<?php

use App\Section;
use App\Myclass;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'section_number' => $faker->randomElement(['A', 'B','C','D','E','F','G','H','I','J','K','L','M']),
        'room_number'    => $faker->randomDigitNotNull,
        'class_id'       => function() use ($faker) {
            if (Myclass::count())
                return $faker->randomElement(Myclass::pluck('id')->toArray());
            else return factory(Myclass::class)->create()->id;
        },
    ];
});
