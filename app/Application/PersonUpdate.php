<?php

namespace App\Application;

use App\Http\Interfaces\IPersonUpdate;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Application\Interfaces\IFindPersonById;
use App\Application\Interfaces\IPersistPersonRepository;

class PersonUpdate implements IPersonUpdate
{
    private $finder;
    private $repository;

    public function __construct(IFindPersonById $finder, IPersistPersonRepository $repository)
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function execute(Request $request, int $id)
    {
        $person = $this->finder->findById($id);

        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->cpf = $request->cpf;        

        return $this->repository->persist($person);
    }
}