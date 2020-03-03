<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records of customers
        factory(App\Models\Person::class, 10)->create()->each(function ($person) {
            // Seed the relation with one address
            $address = factory(App\Models\Address::class)->make();
            $person->address()->save($address);

            $contact = factory(App\Models\Contact::class)->make();
            $person->contact()->save($contact);
        });
    }
}
