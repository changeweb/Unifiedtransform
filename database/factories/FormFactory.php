<?php

use App\User;
use App\Form;
use App\School;
use Faker\Generator as Faker;

$factory->define(Form::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'file_path' => $faker->url,
        'school_id' => factory(School::class)->create()->id,
        'user_id'   => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
