<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'phone_number' => $faker->randomNumber(7, false),
        'email' => $faker->unique()->safeEmail,
        'message' => $faker->sentences(3, true),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
