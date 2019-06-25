<?php

use Faker\Generator as Faker;

$factory->define(App\PlanTypeWash::class, function (Faker $faker) {
    return [
        'type_wash_id' => \App\Wash_type::all()->random()->id,
        'quantity' => rand(1, 3),
    ];
});
