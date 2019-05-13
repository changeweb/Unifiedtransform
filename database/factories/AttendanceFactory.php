<?php

use App\User;
use App\Exam;
use App\School;
use App\Section;
use App\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'present'    => $faker->randomElement([0,1,2]),
        'student_id' => function () use ($faker) {
            if (User::student()->count())
                return $faker->randomElement(User::student()->take(10)->pluck('id')->toArray());
            else return factory(User::class)->create(['role' => 'student'])->id;
        },
        'section_id' => function () use ($faker) {
            if (Section::count())
                return $faker->randomElement(Section::pluck('id')->toArray());
            else return factory(Section::class)->create()->id;
        },
        'exam_id'    => function () use ($faker) {
            if (Exam::count())
                return $faker->randomElement(Exam::bySchool($faker->randomElement(School::pluck('id')->toArray()))->pluck('id')->toArray());
            else return factory(Exam::class)->create()->id;
        },
        'user_id'    => function () use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
