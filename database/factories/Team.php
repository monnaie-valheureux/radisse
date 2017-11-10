<?php

use App\Team;
use Faker\Generator as Faker;

// Factory to create a basic Team model.
$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
    ];
});
