<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->words(3, true),
        'class_id' => $faker->randomElement(App\Myclass::pluck('id')->toArray()),
        'course_type' => $faker->randomElement(['Core','Elective']),
        'course_time' => $faker->randomElement(['9:30AM-10:20AM','12:50PM-01:40PM']),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'teacher_id' => $faker->randomElement(App\User::where('role', 'teacher')->take(10)->pluck('id')->toArray()),
        'section_id' => $faker->randomElement(App\Section::pluck('id')->toArray()),
        'grade_system_name' => $faker->randomElement(App\Gradesystem::where('school_id',1)->pluck('grade_system_name')->toArray()),
        'exam_id' => $faker->randomElement(App\Exam::where('active',1)->pluck('id')->toArray()),
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
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
