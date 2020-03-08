<?php

namespace App\Application;

use App\Http\Interfaces\IPersonDelete;
// use App\Models\Person;
// use Illuminate\Http\Request;
use App\Application\Interfaces\IFindPersonById;
use App\Application\Interfaces\IDeletePersonRepository;

class PersonDelete implements IPersonDelete
{
    private $finder;
    private $repository;

    public function __construct(IFindPersonById $finder, IDeletePersonRepository $repository)
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function execute(int $id)
    {
        $person = $this->finder->findById($id);
        $this->repository->delete($person);
        // $person = Person::findOrFail($id);
        // $person->delete();
    }
}