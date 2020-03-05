<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonControllerTest extends TestCase
{
    /**
     * @test
     */
    public function can_create_a_person()
    {
        $faker = Factory::create();

        $response = $this->json('POST', '/api/pessoas', [
            'first_name' => $firstName = $faker->firstName,
            'last_name' => $lastName = $faker->lastName,
            'cpf' => $cpf = substr($faker->postcode, 0, 9),
            'address' => ['cep' => '88811570'],
            'contact' => [
                'phone' => $phone = $faker->phoneNumber,
                'email' => $email = $faker->safeEmail,
                'mobile' => $mobile = $faker->phoneNumber
            ]
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('people', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'cpf' => $cpf,         
        ]);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_person_itens()
    {
        $response = $this->json('GET', '/api/pessoas');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 
                        'contact' => ['phone', 'email', 'mobile'], 
                        'address' => ['cep', 'street', 'district', 'city', 'state'], 
                        'first_name', 
                        'last_name', 
                        'cpf'
                    ]
                ],
                'links' => ['first', 'last', 'prev', 'next'],
                'meta' => ['current_page', 'last_page', 'from', 'to', 'path', 'per_page', 'total']
            ]);
    }


    /**
     * @test
     */
    public function will_fail_tith_a_404_if_person_not_found()
    {
        $response = $this->json('GET', "api/pessoas/-1");
        $response->assertStatus(404);
    }

}
