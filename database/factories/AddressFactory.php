<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'person_id' => factory('App\Models\Person')->create()->id,
        'cep' => substr($faker->postcode, 0, 7),
        'street' => $faker->streetName,
        'district' => $faker->company,
        'city' => $faker->city,
        'state' => $faker->state,
    ];
});
