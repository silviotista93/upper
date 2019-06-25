<?php

use Faker\Generator as Faker;

$factory->define(App\Enterprise::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'name' => $faker->company,
        'nit' => $faker->unixTime,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});
