<?php

use Faker\Generator as Faker;

$factory->define(App\Fee::class, function (Faker $faker) {
    return [
      'fee_name' => $faker->name,
      'school_id' => function () use ($faker) {
          if(App\School::count() == 0)
            return factory(App\School::class)->create()->id;
          else {
            return $faker->randomElement(App\School::pluck('id')->toArray());
          }
        },
      // 'admission_fee' => $faker->randomNumber,
      // 'tution_fee' => $faker->randomNumber,
      // 'fine_fee' => $faker->randomNumber,
      // 'exam_fee' => $faker->randomNumber,
      // 'registration_fee' => $faker->randomNumber,
      // 'library_fee' => $faker->randomNumber,
      // 'lab_fee' => $faker->randomNumber,
      // 'sport_fee' => $faker->randomNumber,
      // 'late_payment_fee' => $faker->randomNumber,
      // 'maintenance_fee' => $faker->randomNumber,
      // 'internet_fee' => $faker->randomNumber,
      // 'farewell_fee' => $faker->randomNumber,
      // 'other_fee' => $faker->randomNumber,
      'user_id' => function () use ($faker) {
          if(App\User::count() == 0)
            return factory(App\User::class)->create()->id;
          else {
            return $faker->randomElement(App\User::pluck('id')->toArray());
          }
        },
    ];
});
