<?php

namespace App\Application\Interfaces;

use App\Models\Person;

interface IDeletePersonRepository
{
    function delete(Person $person);
}