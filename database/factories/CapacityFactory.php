<?php

use Faker\Generator as Faker;
use App\Capacity;

$factory->define(Capacity::class, function (Faker $faker) {
    return [
        "id" => $faker->unique()->randomNumber($nbDigits = 4),
        "name" =>  $faker->name,
        "code" =>  $faker->ean8,
        "state"=> 1
    ];
});
