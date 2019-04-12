<?php

use Faker\Generator as Faker;

$factory->define(App\Issuedbook::class, function (Faker $faker) {
    return [
      'student_code' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->student_code;
          else {
            return $faker->randomElement(App\User::pluck('student_code')->toArray());
          }
        },
      'book_id' => function () use ($faker) {
          if(App\Book::count() == 0)
            return factory(App\Book::class)->create()->id;
          else {
            return $faker->randomElement(App\Book::pluck('id')->toArray());
          }
        },
      'quantity' => $faker->randomElement([5,8,19,13,34]),
      'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
      'issue_date' => $faker->date('Y-m-d', 'now'),
      'return_date' => $faker->date('Y-m-d', 'now'),
      'fine' => $faker->randomElement([5,8,19,13,34]),
      'borrowed' => $faker->randomElement([1,0]),
      'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
    ];
});
