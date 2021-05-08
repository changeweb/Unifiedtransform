<?php

use App\Fee;
use App\User;
use App\School;
use Faker\Generator as Faker;

$factory->define(Fee::class, function (Faker $faker) {
    return [
        'fee_name'  => $faker->name,
        'school_id' => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'user_id'   => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});

// 'admission_fee'    => $faker->randomNumber,
// 'tution_fee'       => $faker->randomNumber,
// 'fine_fee'         => $faker->randomNumber,
// 'exam_fee'         => $faker->randomNumber,
// 'registration_fee' => $faker->randomNumber,
// 'library_fee'      => $faker->randomNumber,
// 'lab_fee'          => $faker->randomNumber,
// 'sport_fee'        => $faker->randomNumber,
// 'late_payment_fee' => $faker->randomNumber,
// 'maintenance_fee'  => $faker->randomNumber,
// 'internet_fee'     => $faker->randomNumber,
// 'farewell_fee'     => $faker->randomNumber,
// 'other_fee'        => $faker->randomNumber,
