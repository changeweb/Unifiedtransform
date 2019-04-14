<?php

use App\Book;
use App\User;
use App\School;
use App\Myclass;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'book_code' => 'bk'.$faker->unique()->randomNumber(7, false),
        'title'     => $faker->sentences(1, true),
        'author'    => $faker->name,
        'quantity'  => $faker->randomElement([5,8,19,13,34]),
        'rackNo'    => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
        'rowNo'     => $faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
        'type'      => $faker->randomElement(['Academic','Magazine','Story','Other']),
        'img_path'  => $faker->imageUrl($width = 150, $height = 150, 'cats'),
        'about'     => $faker->sentences(3, true),
        'price'     => $faker->randomNumber,
        'class_id'  => function() use ($faker) {
                            if (Myclass::count()) {
                                return $faker->randomElement(Myclass::pluck('id')->toArray());
                            } else return factory(Myclass::class)->create()->id;
                        },
        'school_id'  => function() use ($faker) {
                            if (School::count()) {
                                return $faker->randomElement(School::pluck('id')->toArray());
                            } else return factory(School::class)->create()->id;
                        },
        'user_id'    => function() use ($faker) {
                            if (User::count()) {
                                return $faker->randomElement(User::pluck('id')->toArray());
                            } else return factory(User::class)->states('librarian')->create()->id;
                        }
    ];
});
