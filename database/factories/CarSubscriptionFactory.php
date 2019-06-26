<?php

use Faker\Generator as Faker;

$factory->define(App\CarSubscription::class, function (Faker $faker) {
    return [
        'subscription_id' => \App\Subscription::all()->random()->id,
        'cars_id' => \App\Car::all()->random()->id
    ];
});
