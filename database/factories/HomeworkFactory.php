<?php

use Faker\Generator as Faker;

$factory->define(App\Homework::class, function (Faker $faker) {
    return [
        'file_path' => $faker->url,
        'description' => $faker->sentences(3, true),
        'teacher_id' => $faker->randomElement(App\User::where('role', 'teacher')->pluck('id')->toArray()),
        'section_id' => $faker->randomElement(App\Section::pluck('id')->toArray())
    ];
});
