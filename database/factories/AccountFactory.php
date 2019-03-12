<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement(['income','expense']),
        'amount' => $faker->randomNumber(4, false),
        'description' => $faker->sentences(3, true),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
    ];
});
