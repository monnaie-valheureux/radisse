<?php

use App\Location;
use App\CurrencyExchange;
use Faker\Generator as Faker;

// Factory to create a basic CurrencyExchange model.
$factory->define(CurrencyExchange::class, function (Faker $faker) {
    return [
        'location_id' => function () {
            return factory(Location::class)->create()->id;
        }
    ];
});
