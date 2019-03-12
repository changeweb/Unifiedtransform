<?php

use Faker\Generator as Faker;

$factory->define(App\Form::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'file_path' => $faker->url,
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
