<?php

use Faker\Generator as Faker;

$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        'exam_name' => $faker->words(3, true),
        'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
        'term' => $faker->sentence,
        'active' => $faker->randomElement([0,1]),
        'start_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'end_date' => $faker->dateTime()->format('Y-m-d H:i:s'),
        'notice_published' => $faker->randomElement([0,1]),
        'result_published' => $faker->randomElement([0,1]),
        'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
