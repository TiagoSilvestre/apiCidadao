<?php

namespace App\Application;

use App\Http\Interfaces\IPersonFind;
use App\Application\Interfaces\IFindPersonById;
use App\Application\Interfaces\IDeletePersonRepository;

class PersonFind implements IPersonFind
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
        return $person;
    }
}