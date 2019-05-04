<?php

use Faker\Generator as Faker;
use App\Nature;

$factory->define(Nature::class, function (Faker $faker) {
    return [
        "id" => $faker->unique()->randomNumber($nbDigits = 4),
        "name" =>  $faker->name,
        "code" =>  $faker->ean8,
        "state"=> 1
    ];
});
