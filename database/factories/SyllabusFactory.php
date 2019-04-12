<?php

use Faker\Generator as Faker;

$factory->define(App\Syllabus::class, function (Faker $faker) {
    return [
    	'file_path' => $faker->url,
      'description' => $faker->sentences(3, true),
      'title' => $faker->sentences(1, true),
      'active' => $faker->randomElement([0, 1]),
      'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
      'class_id' => $faker->randomElement(App\Myclass::pluck('id')->toArray()),
      'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
    ];
});
