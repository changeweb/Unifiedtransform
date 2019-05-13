<?php

use App\Exam;
use App\User;
use App\Grade;
use App\Course;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'gpa'         => $faker->randomNumber(1, false),
        'marks'       => $faker->randomNumber(2, false),
        'attendance'  => 5,
        'quiz1'       => $faker->randomNumber(2, false),
        'quiz2'       => $faker->randomNumber(2, false),
        'quiz3'       => $faker->randomNumber(2, false),
        'quiz4'       => $faker->randomNumber(2, false),
        'quiz5'       => $faker->randomNumber(2, false),
        'ct1'         => $faker->randomNumber(2, false),
        'ct2'         => $faker->randomNumber(2, false),
        'ct3'         => $faker->randomNumber(2, false),
        'ct4'         => $faker->randomNumber(2, false),
        'ct5'         => $faker->randomNumber(2, false),
        'assignment1' => $faker->randomNumber(2, false),
        'assignment2' => $faker->randomNumber(2, false),
        'assignment3' => $faker->randomNumber(2, false),
        'written'     => $faker->randomNumber(2, false),
        'mcq'         => $faker->randomNumber(2, false),
        'practical'   => $faker->randomNumber(2, false),
        'exam_id'     => function () use ($faker) {
          if (Exam::count())
            return $faker->randomElement(Exam::pluck('id')->toArray());
          else return factory(Exam::class)->create()->id;
        },
        'student_id'  => function () use ($faker) {
          if (User::student()->count())
            return $faker->randomElement(User::student()->take(10)->pluck('id')->toArray());
          else return factory(User::class)->create(['role' => 'student'])->id;
        },
        'teacher_id'  => function () use ($faker) {
          if (User::where('role', 'teacher')->count())
            return $faker->randomElement(User::where('role', 'teacher')->take(10)->pluck('id')->toArray());
          else return factory(App\User::class)->create(['role' => 'teacher'])->id;
        },
        'course_id'   => function () use ($faker) {
          if (Course::count())
            return $faker->randomElement(Course::take(10)->pluck('id')->toArray());
          else return factory(Course::class)->create()->id;
        },
        'user_id'     => function () use ($faker) {
          if (User::count())
            return $faker->randomElement(User::pluck('id')->toArray());
          else return factory(User::class)->create()->id;
        },
    ];
});
