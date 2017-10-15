<?php

use App\Location;
use Faker\Generator as Faker;

// Factory to create a basic Location model.
$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => "{$faker->company} {$faker->city}",
    ];
});
