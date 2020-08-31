<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Voucher;
use Faker\Generator as Faker;

$factory->define(Voucher::class, function (Faker $faker) {
    return [
        "date_sale"=>$faker->date($format = 'Y-m-d', $max = 'now'),
        "payment_method"=>"efectivo",
        "active"=>true,
        "clients_id"=>$faker->numberBetween($min=1, $max=100),
        "users_id"=>1,
        "sellers_id"=>$faker->numberBetween($min=1, $max=10)
    ];
});
