<?php

use App\User;
use App\School;
use App\Routine;
use App\Section;
use Faker\Generator as Faker;

$factory->define(Routine::class, function (Faker $faker) {
    return [
        'file_path'   => $faker->url,
        'title'       => $faker->sentences(1, true),
        'description' => $faker->sentences(3, true),
        'active'      => $faker->randomElement([0, 1]),
        'school_id'   => function() use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'section_id' => function() use ($faker) {
            if (Section::count())
                return $faker->randomElement(Section::pluck('id')->toArray());
            else return factory(Section::class)->create()->id;
        },
        'user_id'    => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
