<?php

use App\User;
use App\Exam;
use App\School;
use App\Course;
use App\Myclass;
use App\Section;
use App\Gradesystem;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->words(3, true),
        'class_id'    => function () use ($faker) {
            if (Myclass::count())
                return $faker->randomElement(Myclass::pluck('id')->toArray());
            else return factory(Myclass::class)->create()->id;
        },
        'course_type' => $faker->randomElement(['Core','Elective']),
        'course_time' => $faker->randomElement(['9:30AM-10:20AM','12:50PM-01:40PM']),
        'school_id'   => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'teacher_id'  => function () use ($faker) {
            if (User::where('role', 'teacher')->count())
                return $faker->randomElement(User::where('role', 'teacher')->take(10)->pluck('id')->toArray());
            else return factory(User::class)->create(['role' => 'teacher'])->id;
        },
        'section_id'        => function () use ($faker) {
            if (Section::count())
                return $faker->randomElement(Section::pluck('id')->toArray());
            else return factory(Section::class)->create()->id;
        },
        'grade_system_name' => function () use ($faker) {
            if (Gradesystem::count())
                return $faker->randomElement(Gradesystem::pluck('grade_system_name')->toArray());
            else return factory(Gradesystem::class)->create()->grade_system_name;
        },
        'exam_id'           => function () use ($faker) {
            if (Exam::count())
                return $faker->randomElement(Exam::pluck('id')->toArray());
            else return factory(Exam::class)->create()->id;
        },
        'quiz_count'         => $faker->randomElement([1,2,3,4,5]),
        'assignment_count'   => $faker->randomElement([1,2,3]),
        'ct_count'           => $faker->randomElement([1,2,3,4,5]),
        'quiz_percent'       => 10,
        'attendance_percent' => 5,
        'assignment_percent' => 15,
        'ct_percent'         => 10,
        'final_exam_percent' => 50,
        'practical_percent'  => 25,
        'att_fullmark'       => 5,
        'quiz_fullmark'      => 15,
        'a_fullmark'         => 20,
        'ct_fullmark'        => 15,
        'final_fullmark'     => 100,
        'practical_fullmark' => 30,
        'user_id' => function () use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
