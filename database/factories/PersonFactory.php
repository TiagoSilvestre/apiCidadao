<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use App\Models\Contact;
use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'cpf' => $faker->cpf,
    ];
});


$factory->define(Address::class, function (Faker $faker) {
    return [
        'cep' => substr($faker->postcode, 0, 9),
        'street' => $faker->streetName,
        'district' => $faker->company,
        'city' => $faker->city,
        'state' => $faker->state,
    ];
});


$factory->define(Contact::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->phoneNumber
    ];
});
