<?php

use Faker\Generator as Faker;

$factory->define(App\Issuedbook::class, function (Faker $faker) {
    return [
      'student_code' => $faker->randomElement(App\User::pluck('student_code')->toArray()),
      'book_code' => $faker->randomElement(App\Book::pluck('book_code')->toArray()),
      'quantity' => $faker->randomElement([5,8,19,13,34]),
      'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
      'issue_date' => $faker->date('Y-m-d', 'now'),
      'return_date' => $faker->date('Y-m-d', 'now'),
      'fine' => $faker->randomElement([5,8,19,13,34]),
      'borrowed' => $faker->randomElement([1,0]),
    ];
});
