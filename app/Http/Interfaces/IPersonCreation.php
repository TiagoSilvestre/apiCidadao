<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface IPersonCreation
{
    function execute(Request $request);
}