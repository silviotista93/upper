<?php

use App\User;
use Illuminate\Support\Str;
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
    $name = $faker->name;
    $last_name = $faker->lastName;
    $state = $faker->randomElement([\App\User::ACTIVE, \App\User::INACTIVE]);
    return [
        'names' => $name,
        'last_name' => $last_name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => "/storage/users/".\Faker\Provider\Image::image(storage_path() . '/app/public/users', 300, 300, 'people', false),
        'slug' => Str::slug($name. mt_rand(1,10000), '-'),
        'state' => $state,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'), // secret
        'remember_token' => Str::random(10)

    ];
});
