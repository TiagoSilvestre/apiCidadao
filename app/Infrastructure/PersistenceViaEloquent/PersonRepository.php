<?php

namespace App\Infrastructure\PersistenceViaEloquent;

use App\Application\Interfaces\IPersistPersonRepository;
use App\Application\Interfaces\IDeletePersonRepository;
use App\Application\Interfaces\IFindPersonById;
use App\Models\Person;

class PersonRepository implements IPersistPersonRepository, IFindPersonById, IDeletePersonRepository
{
    public function persist(Person $person)
    {
        $person->save();
        return $person;
    }

    public function findById(int $id)
    {
        $person = Person::findOrFail($id);
        return $person;
    }

    public function delete(Person $person)
    {
        $person->delete();
    }

}
