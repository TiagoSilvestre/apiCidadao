<?php

namespace App\Application\Interfaces;

use App\Models\Person;

interface IPersistPersonRepository
{
    function persist(Person $person);
}