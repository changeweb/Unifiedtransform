<?php

use Faker\Generator as Faker;

$factory->define(App\Myclass::class, function (Faker $faker) {
    static $class_number = 0;
    if($class_number > 8){
      return [
      	'class_number' => $class_number++,//$faker->randomDigitNotNull,
        'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
        'group' => $faker->randomElement(['science','commerce','arts']),
      ];
    } else {
      return [
      	'class_number' => $class_number++,//$faker->randomDigitNotNull,
        'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
        'group' => '',
      ];
    }
});
