<?php

use Faker\Generator as Faker;
use App\Message;
use App\School;
use App\User;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'phone_number' => $faker->randomNumber(7, false),
        'email'        => $faker->unique()->safeEmail,
        'message'      => $faker->sentences(3, true),
        'school_id'    => function () use ($faker) {
          if (School::count())
            return $faker->randomElement(School::pluck('id')->toArray());
          else return factory(School::class)->create()->id;
        },
        'user_id'      => function () use ($faker) {
          if (User::count())
            return $faker->randomElement(User::pluck('id')->toArray());
          else return factory(User::class)->create()->id;
        },
    ];
});
