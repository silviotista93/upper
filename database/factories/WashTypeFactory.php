<?php

use Faker\Generator as Faker;

$factory->define(App\Wash_type::class, function (Faker $faker) {
    return [
       /* 'type' => $faker->company,
        'price' => $faker->numberBetween($min = 40000, $max = 90000),
        'description' => $faker->text($maxNbChars = 300),*/
    ];
});
