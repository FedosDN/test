<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        'abbreviation' => 'ZZ',
        'name' => 'ZZZZzzzz',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
