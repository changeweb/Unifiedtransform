<?php

use Faker\Generator as Faker;

$factory->define(App\Fee::class, function (Faker $faker) {
    return [
      'fee_name' => $faker->name,
      'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
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
      'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
