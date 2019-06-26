<?php

use Faker\Generator as Faker;

$factory->define(App\Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text($maxNbChars = 300),
        'picture' => "/storage/plans/".\Faker\Provider\Image::image(storage_path() . '/app/public/plans', 300, 300, 'nature', false),
        'time' => '2019-04-25 08:37:17',
        'price' => $faker->numberBetween($min = 40000, $max = 90000)
    ];
});
