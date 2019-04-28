<?php

use Faker\Generator as Faker;

$factory->define(App\Attendance::class, function (Faker $faker) {
    return [
        'present' => $faker->randomElement([0,1,2]),
        'student_id' => function () use ($faker) {
          if(App\User::student()->count() == 0)
            return factory(App\User::class)->create([
                    'role' => 'student',
            ])->id;
          else {
            return $faker->randomElement(App\User::student()->take(10)->pluck('id')->toArray());
          }
        },
        'section_id' => function () use ($faker) {
          if(App\Section::count() == 0)
            return factory(App\Section::class)->create()->id;
          else {
            return $faker->randomElement(App\Section::pluck('id')->toArray());
          }
        },
        'exam_id' => function () use ($faker) {
          if(App\Exam::count() == 0)
            return factory(App\Exam::class)->create()->id;
          else {
            return $faker->randomElement(App\Exam::where('school_id', $faker->randomElement(App\School::pluck('id')->toArray()))->pluck('id')->toArray());
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
