<?php

use Faker\Generator as Faker;

$factory->define(App\ExamForClass::class, function (Faker $faker) {
    return [
        'class_id' => $faker->randomElement(App\Myclass::pluck('id')->toArray()),
        'exam_id' => $faker->randomElement(App\Exam::where('active',1)->pluck('id')->toArray()),
    ];
});
