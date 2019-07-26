<?php

use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'about'       => $faker->sentences(3, true),
        'medium'      => $faker->randomElement(['bangla', 'english']),
        'code'        => date("y").substr(number_format(time() * mt_rand(),0,'',''),0,6),
        'established' => $faker->name,
        'theme'       => 'flatly',
    ];
});
