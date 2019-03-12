<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'book_code' => $faker->unique()->randomNumber(7, false),
        'title' => $faker->sentences(1, true),
        'author' => $faker->name,
        'quantity' => $faker->randomElement([5,8,19,13,34]),
        'rackNo' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
        'rowNo' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
        'type' => $faker->randomElement(['Academic','Magazine','Story','Other']),
        'img_path' => $faker->url,
        'about' => $faker->sentences(3, true),
        'price' => $faker->randomNumber,
        'class_id' => $faker->randomElement(App\Myclass::pluck('id')->toArray()),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'user_id' =>  $faker->randomElement(App\User::pluck('id')->toArray()),
    ];
});
