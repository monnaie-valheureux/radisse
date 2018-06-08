<?php

use App\Team;
use App\Partner;
use Carbon\Carbon;
use App\TeamMember;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

// Factory to create a basic Partner model.
$factory->define(Partner::class, function (Faker $faker, array $attributes) {

    // Save the name to a variable so that we’ll
    // be able to generate a proper slug for it.
    $name = $attributes['name'] ?? $faker->company;

    return [
        'name' => $name,
        'name_sort' => $name,
        'slug' => Str::slug($name),
        'validated_at' => Carbon::parse('1 week ago'),
        'team_id' => function () {
            return factory(Team::class)->create()->id;
        },
        'endorser_team_member_id' => function () {
            return factory(TeamMember::class)->create()->id;
        },
        'validator_team_member_id' => function () {
            return factory(TeamMember::class)->create()->id;
        }
    ];
});

// State to turn a partner into a validated one.
$factory->state(Partner::class, 'validated', [
    'validated_at' => Carbon::parse('1 week ago'),
]);

// State to turn a partner into a nonvalidated one.
$factory->state(Partner::class, 'nonvalidated', [
    'validated_at' => null,
]);

// State to turn a partner into a former partner,
// who left the network of the currency.
$factory->state(Partner::class, 'former', [
    'left_on' => Carbon::parse('3 months ago'),
]);
