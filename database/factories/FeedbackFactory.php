<?php

use Faker\Generator as Faker;

$factory->define(App\Feedback::class, function (Faker $faker) {
    return [
        'description' => $faker->sentences(3, true),
        'student_id' => $faker->randomElement(App\User::where('role', 'student')->pluck('id')->toArray()),
        'teacher_id' => $faker->randomElement(App\User::where('role', 'teacher')->pluck('id')->toArray())
    ];
});
