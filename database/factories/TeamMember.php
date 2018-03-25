<?php

use App\Team;
use App\TeamMember;
use Faker\Generator as Faker;

// Factory to create a basic TeamMember model.
$factory->define(TeamMember::class, function (Faker $faker) {
    return [
        'given_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->safeEmail,
        // Bcrypt hash of the string ‘secret’, with a cost factor of 4.
        // This allows to avoid needlessly wasting time and resources
        // on repeatedly hashing the same hardcoded test password.
        'password' => '$2y$04$pfbuiURJw2RWGDngwVx4GOvNvrRbal1P5pkjbF.LgPpg2LrIVSMi6',
        'team_id' => function () {
            return factory(Team::class)->create()->id;
        }
    ];
});
