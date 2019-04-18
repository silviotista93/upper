<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Car::class, function (Faker $faker) {
    return [

        'board' => $faker->numerify('QER ###'),
        'picture' => "/storage/cars/".\Faker\Provider\Image::image(storage_path() . '/app/public/cars', 300, 300, 'transport', false),
        'car_type_id' => \App\CarType::all()->random()->id,
        'cilindraje_id' => \App\Cilindraje::all()->random()->id,
        'color_id' => \App\Color::all()->random()->id,
        'brand_id' => \App\Brand::all()->random()->id,
        'user_id' => \App\User::whereHas('roles', function($q) {
            $q->where('roles_id', '=', 3);
        })->get()->random()->id,
    ];
});
