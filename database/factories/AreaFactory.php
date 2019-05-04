<?php

use App\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        "id" => $faker->unique()->randomNumber($nbDigits = 4),
        "name" =>  $faker->name,
        "code" =>  $faker->ean8,
        "state"=> 1
    ];
});
