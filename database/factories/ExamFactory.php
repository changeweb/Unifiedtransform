<?php

use Faker\Generator as Faker;

$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        'exam_name' => $faker->words(3, true),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'active' => $faker->randomElement([0,1]),
        'notice_published' => $faker->randomElement([0,1]),
        'result_published' => $faker->randomElement([0,1]),
        'user_id' => $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
