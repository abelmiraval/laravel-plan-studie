<?php

use Faker\Generator as Faker;
use App\Content;

$factory->define(Content::class, function (Faker $faker) {
    return [
        "id" => $faker->unique()->randomNumber($nbDigits = 4),
        "name" =>  $faker->name,
        "code" =>  $faker->ean8,
        "state"=> 1
    ];
});
