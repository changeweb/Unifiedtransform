<?php

use App\User;
use App\StudentBoardExam;
use Faker\Generator as Faker;

$factory->define(StudentBoardExam::class, function (Faker $faker) {
    $student_id =$faker->randomElement(User::student()->pluck('id')->toArray());
    return [
      'student_id'       => $student_id,
      'user_id'          => $student_id,
      'exam_name'        => $faker->randomElement(['JSC','SSC','O Level', 'A Level']),
      'group'            => $faker->randomElement(['science','commerce','arts']),
      'roll'             => $faker->randomNumber(7, false),
      'registration'     => $faker->randomNumber(7, false),
      'session'          => '2018-19',
      'board'            => $faker->randomElement(['dhaka','rajsahi','sylhet']),
      'passing_year'     => 2011,
      'institution_name' => 'efnj school',
      'gpa'              => 5.00,
    ];
});
