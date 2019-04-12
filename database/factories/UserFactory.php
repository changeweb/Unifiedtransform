<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active'         => 1,
        'role'           => $faker->randomElement(['student', 'teacher', 'admin', 'accountant', 'librarian']),
        'school_id'      => $faker->randomElement(App\School::pluck('id')->toArray()),
        'code'           => $faker->randomElement(App\School::pluck('code')->toArray()),
        'student_code'   => $faker->unique()->randomNumber(7, false),
        'address'        => $faker->address,
        'about'          => $faker->sentences(3, true),
        'pic_path'       => $faker->imageUrl(640, 480),
        'phone_number'   => $faker->unique()->phoneNumber,
        'verified'       => 1,
        'section_id'     => $faker->randomElement(App\Section::pluck('id')->toArray()),
        'blood_group'    => $faker->randomElement(['a+','b+','ab', 'o+']),
        'nationality'    => 'Bangladeshi',
        'gender'         => $faker->randomElement(['male', 'female']),
    ];
});

$factory->state(App\User::class, 'accountant', [
    'role' => 'accountant'
]);

$factory->state(App\User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(App\User::class, 'librarian', [
    'role' => 'librarian'
]);

$factory->state(App\User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(App\User::class, 'student', [
    'role' => 'student'
]);
