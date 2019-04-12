<?php

use App\User;
use App\School;
use App\Section;
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
$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active'         => 1,
        'role'           => $faker->randomElement(['student', 'teacher', 'admin', 'accountant', 'librarian']),
        'school_id' => function () use ($faker) {
          if(School::count() == 0)
            return factory(School::class)->create()->id;
          else {
            return $faker->randomElement(School::pluck('id')->toArray());
          }
        },
        'code' => function () use ($faker) {
          if(School::count() == 0)
            return factory(School::class)->create()->code;
          else {
            return $faker->randomElement(School::pluck('code')->toArray());
          }
        },
        'student_code'   => $faker->unique()->randomNumber(7, false),
        'address'        => $faker->address,
        'about'          => $faker->sentences(3, true),
        'pic_path'       => $faker->imageUrl(640, 480),
        'phone_number'   => $faker->unique()->phoneNumber,
        'verified'       => 1,
        'section_id' => function () use ($faker) {
          if(Section::count() == 0)
            return factory(Section::class)->create()->id;
          else {
            return $faker->randomElement(Section::pluck('id')->toArray());
          }
        },
        'department_id' => function () use ($faker) {
          if(App\Department::count() == 0)
            return factory(App\Department::class)->create()->id;
          else {
            return $faker->randomElement(App\Department::pluck('id')->toArray());
          }
        },
        'blood_group'    => $faker->randomElement(['a+','b+','ab', 'o+']),
        'nationality'    => 'Bangladeshi',
        'gender'         => $faker->randomElement(['male', 'female']),
    ];
});

$factory->state(User::class, 'master', [
    'role' => 'master'
]);

$factory->state(User::class, 'accountant', [
    'role' => 'accountant'
]);

$factory->state(User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(User::class, 'librarian', [
    'role' => 'librarian'
]);

$factory->state(User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(User::class, 'student', [
    'role' => 'student'
]);
