<?php

use App\Partner;
use Carbon\Carbon;
use Faker\Generator as Faker;

// Factory to create a basic Partner model.
$factory->define(Partner::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'validated_at' => Carbon::parse('1 week ago'),
    ];
});

// Factory state to transform a partner to a former
// partner, who left the network of the currency.
$factory->state(Partner::class, 'former', [
    'left_on' => Carbon::parse('3 months ago'),
]);
