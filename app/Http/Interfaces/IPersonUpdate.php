<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface IPersonUpdate
{
    function execute(Request $request, int $id);
}