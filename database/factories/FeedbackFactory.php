<?php

use App\User;
use App\Feedback;
use Faker\Generator as Faker;

$factory->define(Feedback::class, function (Faker $faker) {
    return [
        'description' => $faker->sentences(3, true),
        'student_id'  => $faker->randomElement(User::student()->pluck('id')->toArray()),
        'teacher_id'  => $faker->randomElement(User::where('role', 'teacher')->pluck('id')->toArray())
    ];
});
