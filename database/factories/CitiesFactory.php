<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    $county = factory(App\Models\County::class)->make();

    return [
        'county_id' => $county->id,
        'name' => $faker->country,
        'zip' => $faker->numberBetween(10000, 99999),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'zcta' => false,
        'parent_zcta' => null,
        'population' => null,
        'density' => null,
        'imprecise' => false,
        'military' => false,
        'timezone' => $faker->timezone,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
