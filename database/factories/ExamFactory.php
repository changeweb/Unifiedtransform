<?php

use App\User;
use App\Exam;
use App\School;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Exam::class, function (Faker $faker) {
    return [
        'exam_name' => $faker->words(3, true),
        'school_id' => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'term'             => $faker->text(20),
        'active'           => $faker->randomElement([0,1]),
        'start_date'       => $faker->dateTime()->format('Y-m-d H:i:s'),
        'end_date'         => $faker->dateTime()->format('Y-m-d H:i:s'),
        'notice_published' => $faker->randomElement([0,1]),
        'result_published' => $faker->randomElement([0,1]),
        'user_id'          => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
