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
/**
   * getRandomWeightedElement()
   * Utility function for getting random values with weighting.
   * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
   * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
   * The return value is the array key, A, B, or C in this case.  Note that the values assigned
   * do not have to be percentages.  The values are simply relative to each other.  If one value
   * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
   * chance of being selected.  Also note that weights should be integers.
   *
   * @param array $weightedValues
   */
  function getRandomWeightedElement(array $weightedValues) {
    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
  }
$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active' => 1,
        'role' => getRandomWeightedElement(['student'=> 40, 'teacher'=>30, 'admin'=>10, 'accountant'=>10, 'librarian' => 10]),
        'school_id' => $faker->randomElement(App\School::pluck('id')->toArray()),
        'code' => $faker->randomElement(App\School::pluck('code')->toArray()),
        'student_code' => $faker->unique()->randomNumber(7, false),
        'address' => $faker->address,
        'about' => $faker->sentences(3, true),
        'pic_path' => $faker->imageUrl(640, 480),
        'phone_number' => $faker->unique()->phoneNumber,
        'verified' => 1,
        'section_id' => $faker->randomElement(App\Section::pluck('id')->toArray()),
        'blood_group' => $faker->randomElement(['a+','b+','ab', 'o+']),
        'nationality' => 'Bangladeshi',
        'gender' => $faker->randomElement(['male', 'female']),
    ];
});
