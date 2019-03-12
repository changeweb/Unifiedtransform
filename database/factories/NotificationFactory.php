<?php

use Faker\Generator as Faker;

$factory->define(App\Notification::class, function (Faker $faker) {
    return [
        'sent_status' => $faker->randomElement([0, 1]),
        'active' => $faker->randomElement([0, 1]),
        'message' => $faker->sentences(3, true),
        'student_id' => $faker->randomElement(App\User::where('role', 'student')->pluck('id')->toArray()),
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
