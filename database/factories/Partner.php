<?php

use App\Partner;
use Faker\Generator as Faker;

// Factory to create a basic Partner model.
$factory->define(Partner::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});
