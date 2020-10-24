<?php

use App\Exam;
use App\Myclass;
use App\ExamForClass;
use Faker\Generator as Faker;

$factory->define(ExamForClass::class, function (Faker $faker) {
    return [
        'class_id' => $faker->randomElement(Myclass::pluck('id')->toArray()),
        'exam_id'  => $faker->randomElement(Exam::where('active', 1)->pluck('id')->toArray()),
        'active'   => $faker->randomElement([0, 1]),
    ];
});
