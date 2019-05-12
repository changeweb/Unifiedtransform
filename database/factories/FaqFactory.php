<?php

use App\Faq;
use App\User;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(6, true),
        'answer'   => $faker->sentences(3, true),
        'user_id'  => function () use ($faker) {
          if (User::count())
            return $faker->randomElement(User::pluck('id')->toArray());
          else return factory(User::class)->create()->id;
        },
    ];
});
