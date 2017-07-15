<?php

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'order' => 1,
        'type_id' => 1,
        'title' => 'dummy question',
        'description' => 'dummy description',
        'comment_placeholder' => 'More info (optional)'
    ];
});

$factory->define(App\Option::class, function (Faker\Generator $faker) {
    return [
        'order' => 1,
        'answer' => 'option 1',
        'canComment' => false
    ];
});