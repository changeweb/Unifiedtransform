<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->words(3, true),
        'class_id' => function () use ($faker) {
          if(App\Myclass::count() == 0)
            return factory(App\Myclass::class)->create()->id;
          else {
            return $faker->randomElement(App\Myclass::pluck('id')->toArray());
          }
        },
        'course_type' => $faker->randomElement(['Core','Elective']),
        'course_time' => $faker->randomElement(['9:30AM-10:20AM','12:50PM-01:40PM']),
        'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
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
        'section_id' => function () use ($faker) {
          if(App\Section::count() == 0)
            return factory(App\Section::class)->create()->id;
          else {
            return $faker->randomElement(App\Section::pluck('id')->toArray());
          }
        },
        'grade_system_name' => function () use ($faker) {
          if(App\Gradesystem::count() == 0)
            return factory(App\Gradesystem::class)->create()->grade_system_name;
          else {
            return $faker->randomElement(App\Gradesystem::pluck('grade_system_name')->toArray());
          }
        },
        'exam_id' => function () use ($faker) {
          if(App\Exam::count() == 0)
            return factory(App\Exam::class)->create()->id;
          else {
            return $faker->randomElement(App\Exam::pluck('id')->toArray());
          }
        },
        'quiz_count'=>$faker->randomElement([1,2,3,4,5]),
        'assignment_count'=>$faker->randomElement([1,2,3]),
        'ct_count'=>$faker->randomElement([1,2,3,4,5]),
        'quiz_percent' => 10,
        'attendance_percent' => 5,
        'assignment_percent' => 15,
        'ct_percent' => 10,
        'final_exam_percent' => 50,
        'practical_percent' => 25,
        'att_fullmark' => 5,
        'quiz_fullmark' => 15,
        'a_fullmark' => 20,
        'ct_fullmark' => 15,
        'final_fullmark' => 100,
        'practical_fullmark' => 30,
        'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
    ];
});
