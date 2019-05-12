<?php

use App\User;
use App\Book;
use App\School;
use App\Issuedbook;
use Faker\Generator as Faker;

$factory->define(Issuedbook::class, function (Faker $faker) {
    return [
        'student_code'  => function () use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('student_code')->toArray());
            else return factory(User::class)->create()->student_code;
        },
        'book_id'       => function () use ($faker) {
            if (Book::count())
                return $faker->randomElement(Book::pluck('id')->toArray());
            else return factory(Book::class)->create()->id;
        },
        'quantity'      => $faker->randomElement([5,8,19,13,34]),
        'school_id'     => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'issue_date'    => $faker->date('Y-m-d', 'now'),
        'return_date'   => $faker->date('Y-m-d', 'now'),
        'fine'          => $faker->randomElement([5,8,19,13,34]),
        'borrowed'      => $faker->randomElement([1,0]),
        'user_id'       => function () use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        }
    ];
});
