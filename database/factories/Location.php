<?php

use App\Partner;
use App\Location;
use Faker\Generator as Faker;

// Factory to create a basic Location model.
$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => "{$faker->company} {$faker->city}",
        'partner_id' => function () {
            return factory(Partner::class)->create()->id;
        }
    ];
});
