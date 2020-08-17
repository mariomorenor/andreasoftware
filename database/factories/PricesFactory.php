<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    return [
        'cash'=>$faker->randomFloat($min=2, $max=100, $nbMaxDecimals = 2),
        'cost'=>$faker->randomFloat($min=2, $max=100, $nbMaxDecimals = 2),
        'promo'=>$faker->randomFloat($min=2, $max=100, $nbMaxDecimals = 2),
        'credit'=>$faker->randomFloat($min=2, $max=100, $nbMaxDecimals = 2),
        'stock'=>$faker->numberBetween($min=100, $max=900),
    ];
});
