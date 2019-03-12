<?php

use Faker\Generator as Faker;

$factory->define(App\StudentBoardExam::class, function (Faker $faker) {
    return [
      'student_id' => $faker->randomElement(App\User::where('role', 'student')->pluck('id')->toArray()),
      'exam_name' => $faker->randomElement(['JSC','SSC','O Level', 'A Level']),
      'group' => $faker->randomElement(['science','commerce','arts']),
      'roll' => $faker->randomNumber(7, false),
      'registration' => $faker->randomNumber(7, false),
      'session' => '2018-19',
      'board' => $faker->randomElement(['dhaka','rajsahi','sylhet']),
      'passing_year' => 2011,
      'institution_name' => 'efnj school',
      'gpa' => 5.00,
    ];
});
