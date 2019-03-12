<?php

use Faker\Generator as Faker;

$factory->define(App\Gradesystem::class, function (Faker $faker) {
    return [
      'grade_system_name' => $faker->randomElement(['Grade System 1','Grade System 2']),
      'grade' => $faker->randomElement(['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','F']),
      'point' => $faker->randomElement([2.50,2.75,3.00,3.50,4.00,4.50,5.00]),
      'from_mark' => $faker->randomElement([0,30,60,70,80,90]),
      'to_mark' => $faker->randomElement([60,70,80,90,100]),
      'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
      'user_id' => $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
