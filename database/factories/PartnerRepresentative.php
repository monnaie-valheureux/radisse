<?php

use App\PartnerRepresentative;
use Faker\Generator as Faker;

// Factory to create a basic PartnerRepresentative model.
$factory->define(PartnerRepresentative::class, function (Faker $faker) {
    return [
        'partner_id' => $faker->randomDigitNotNull(),
        'given_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'role' => 'responsable',
    ];
});
