<?php

use App\School;
use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'school_id'       => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'department_name' => $faker->randomElement(['Bangla','English','Math']),
    ];
});
