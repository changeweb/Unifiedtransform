<?php

use App\User;
use App\Certificate;
use App\School;
use Faker\Generator as Faker;

$factory->define(Certificate::class, function (Faker $faker) {
    return [
        'file_path'   => $faker->url,
        'title'       => $faker->sentences(1, true),
        'given_to'    => $faker->randomElement(User::where('role', 'student')->pluck('student_code')->toArray()),
        'active'      => $faker->randomElement([0, 1]),
        'school_id'   => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'user_id'     => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
