<?php
use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Note::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->realText(25),
        'text' => $faker->realText(2000, 2),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Pad::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->realText(10),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
