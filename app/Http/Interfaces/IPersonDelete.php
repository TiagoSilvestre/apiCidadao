<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface IPersonDelete
{
    function execute(int $id);
}