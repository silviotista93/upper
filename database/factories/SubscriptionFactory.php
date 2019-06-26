<?php

use Faker\Generator as Faker;

$factory->define(App\Subscription::class, function (Faker $faker) {
    $state = $faker->randomElement([\App\Subscription::ACTIVE, \App\Subscription::INACTIVE]);
    return [
        'plan_id' => \App\Plan::all()->random()->id,
        'state' => $state,
        'date_start' => '2019-04-19 08:37:17',
        'date_end' => '2019-05-25 08:37:17',
    ];
});
