<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface IPersonFind
{
    function execute(int $id);
}