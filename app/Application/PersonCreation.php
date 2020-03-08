<?php

namespace App\Application;

use App\Http\Interfaces\IPersonCreation;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Application\Interfaces\IPersistPersonRepository;


class PersonCreation implements IPersonCreation
{
    private $repository;

    public function __construct(IPersistPersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Request $request)
    {
        $person = new Person;
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->cpf = $request->cpf;

        return $this->repository->persist($person);
    }
}