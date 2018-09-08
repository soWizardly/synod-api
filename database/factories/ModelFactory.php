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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'type' => random_int(1,2),
        'password' => $faker->password,
        'token' => "A" . bin2hex(random_bytes(20))
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'user_id' => array_rand(\App\User::all(['id'])->toArray()),
        'name' => $faker->sentence,
        'content' => $faker->paragraph
    ];
});

$factory->define(App\Proposal::class, function (Faker\Generator $faker) {
    return [
        'user_id' => array_rand(\App\User::all(['id'])->toArray()),
        'project_id' => array_rand(\App\Project::all(['id'])->toArray()),
        'name' => $faker->sentence,
        'content' => $faker->paragraph
    ];
});

