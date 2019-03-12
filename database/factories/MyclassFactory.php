<?php

use Faker\Generator as Faker;

$factory->define(App\Myclass::class, function (Faker $faker) {
    static $class_number = 0;
    if($class_number > 8){
      return [
      	'class_number' => $class_number++,//$faker->randomDigitNotNull,
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'group' => $faker->randomElement(['science','commerce','arts']),
      ];
    } else {
      return [
      	'class_number' => $class_number++,//$faker->randomDigitNotNull,
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'group' => '',
      ];
    }
});
