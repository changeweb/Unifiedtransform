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
        'exam_id' => function () use ($faker) {
          if(App\Exam::count() == 0)
            return factory(App\Exam::class)->create()->id;
          else {
            return $faker->randomElement(App\Exam::pluck('id')->toArray());
          }
        },
        'student_id' => function () use ($faker) {
          if(App\User::student()->count() == 0)
            return factory(App\User::class)->create([
                    'role' => 'student',
            ])->id;
          else {
            return $faker->randomElement(App\User::student()->take(10)->pluck('id')->toArray());
          }
        },
        'teacher_id' => function () use ($faker) {
          if(App\User::where('role', 'teacher')->count() == 0)
            return factory(App\User::class)->create([
                    'role' => 'teacher',
            ])->id;
          else {
            return $faker->randomElement(App\User::where('role', 'teacher')->take(10)->pluck('id')->toArray());
          }
        },
        'course_id' => function () use ($faker) {
          if(App\Course::count() == 0)
            return factory(App\Course::class)->create()->id;
          else {
            return $faker->randomElement(App\Course::take(10)->pluck('id')->toArray());
          }
        },
        'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
    ];
});
