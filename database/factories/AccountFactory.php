<?php

use App\User;
use App\School;
use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'type'        => $faker->randomElement(['income','expense']),
        'amount'      => $faker->randomNumber(4, false),
        'description' => $faker->sentences(3, true),
        'school_id'   => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'user_id'     => function() use ($faker) {
            if (User::where('role', 'accountant')->count())
                return $faker->randomElement(User::where('role', 'accountant')->pluck('id')->toArray());
            else return factory(User::class)->states('accountant')->create()->id;
        }
    ];
});
