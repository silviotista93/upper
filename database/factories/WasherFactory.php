<?php

use Faker\Generator as Faker;

$factory->define(App\Washer::class, function (Faker $faker) {
    $state = $faker->randomElement([\App\Washer::OCUPADO, \App\Washer::LIBRE]);
    return [
        'user_id' => null,
        'enterprise_id' => null,
        'state' => $state,
    ];
});
