<?php

use App\User;
use App\Section;
use App\Homework;
use Faker\Generator as Faker;

$factory->define(Homework::class, function (Faker $faker) {
    return [
        'file_path'   => $faker->url,
        'description' => $faker->sentences(3, true),
        'teacher_id'  => $faker->randomElement(User::where('role', 'teacher')->pluck('id')->toArray()),
        'section_id'  => $faker->randomElement(Section::pluck('id')->toArray())
    ];
});
