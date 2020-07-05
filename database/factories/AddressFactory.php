<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $country = App\Country::inRandomOrder()->first();
    $state = App\State::where('country_id', $country->id)->first();
    return [
        'address_1' => $faker->address,
        'address_2' => $faker->secondaryAddress,
        'country' => function () use ($country) { return $country->name;},
        'state' => function () use ($state) { return $state->name; },
        'city' => function () use ($state) { return App\City::where('state_id', $state->id)->first()->name;},
        'zipcode' => $faker->postcode
    ];
});
