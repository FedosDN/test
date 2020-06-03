<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\County;
use Faker\Generator as Faker;

$factory->define(County::class, function (Faker $faker) {
    $state = factory(App\Models\State::class)->make();

    $name = $faker->country;
    $fips = $faker->countryCode;

    return [
        'state_id' => $state->id,
        'name' => $name,
        'fips' => $fips,
        'weights' => json_encode([]),
        'names_all' => $name,
        'fips_all' => $fips,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
