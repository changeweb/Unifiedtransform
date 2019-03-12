<?php

use Faker\Generator as Faker;

$factory->define(App\StudentInfo::class, function (Faker $faker) {
    return [
      'student_id' => $faker->randomElement(App\User::where('role', 'student')->pluck('id')->toArray()),
      'session' => '2018',
      'version' => $faker->randomElement(['bangla', 'english']),
      'group' => getRandomWeightedElement([''=>50,'science'=>25,'commerce'=>15,'arts'=>10]),
      'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
      'religion' => $faker->randomElement(['islam','hinduism','christianism','buddhism','other']),
      'father_name' => $faker->name,
      'father_phone_number' => $faker->randomNumber(7, false),
      'father_national_id' => "SA0218IBYZVZJSEC8536V4XC",
      'father_occupation' => $faker->jobTitle,
      'father_designation' => $faker->jobTitle,
      'father_annual_income' => $faker->randomElement([1000000, 500000, 300000, 700000]),
      'mother_name' => $faker->name,
      'mother_name' => $faker->name,
      'mother_phone_number' => $faker->randomNumber(7, false),
      'mother_national_id' => "SA0218IBYZVZJSEC8536V4XC",
      'mother_occupation' => $faker->jobTitle,
      'mother_designation' => $faker->jobTitle,
      'mother_annual_income' => $faker->randomElement([1000000, 500000, 300000, 700000]),
    ];
});
