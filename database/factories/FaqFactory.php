<?php

use Faker\Generator as Faker;

$factory->define(App\Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(6, true),
        'answer' => $faker->sentences(3, true),
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
