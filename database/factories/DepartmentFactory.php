<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'department_name' => $faker->randomElement(['Bangla','English','Math']),
    ];
});
