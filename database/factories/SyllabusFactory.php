<?php

use Faker\Generator as Faker;

$factory->define(App\Syllabus::class, function (Faker $faker) {
    return [
    	'file_path' => $faker->url,
      'description' => $faker->sentences(3, true),
      'title' => $faker->sentences(1, true),
      'active' => $faker->randomElement([0, 1]),
      'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
      'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
