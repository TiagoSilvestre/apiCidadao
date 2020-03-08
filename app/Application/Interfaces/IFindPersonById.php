<?php

namespace App\Application\Interfaces;

use App\Models\Person;

interface IFindPersonById
{
    function findById(int $id);
}