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
        factory(App\Models\Person::class, 10)->create()->each(function ($person) {
            $address = factory(App\Models\Address::class)->make();
            $person->address()->save($address);

            $contact = factory(App\Models\Contact::class)->make();
            $person->contact()->save($contact);
        });
    }
}
