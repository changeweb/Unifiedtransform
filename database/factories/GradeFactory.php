<?php

use Faker\Generator as Faker;

$factory->define(App\Grade::class, function (Faker $faker) {
    return [
        'gpa' => $faker->randomNumber(1, false),
        'marks' => $faker->randomNumber(2, false),
        'attendance' => 5,
        'quiz1' => $faker->randomNumber(2, false),
        'quiz2' => $faker->randomNumber(2, false),
        'quiz3' => $faker->randomNumber(2, false),
        'quiz4' => $faker->randomNumber(2, false),
        'quiz5' => $faker->randomNumber(2, false),
        'ct1' => $faker->randomNumber(2, false),
        'ct2' => $faker->randomNumber(2, false),
        'ct3' => $faker->randomNumber(2, false),
        'ct4' => $faker->randomNumber(2, false),
        'ct5' => $faker->randomNumber(2, false),
        'assignment1' => $faker->randomNumber(2, false),
        'assignment2' => $faker->randomNumber(2, false),
        'assignment3' => $faker->randomNumber(2, false),
        'written' => $faker->randomNumber(2, false),
        'mcq' => $faker->randomNumber(2, false),
        'practical' => $faker->randomNumber(2, false),
        'exam_id' => $faker->randomElement(App\Exam::pluck('id')->toArray()),
        'student_id' => $faker->randomElement(App\User::where('role', 'student')->take(10)->pluck('id')->toArray()),
        'teacher_id' => $faker->randomElement(App\User::where('role', 'teacher')->take(10)->pluck('id')->toArray()),
        'course_id' => $faker->randomElement(App\Course::take(10)->pluck('id')->toArray())
    ];
});
