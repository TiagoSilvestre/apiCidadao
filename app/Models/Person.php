<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';
    protected $fillable = ['first_name','last_name','cpf'];


    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    public function contact()
    {
        return $this->hasOne('App\Models\Contact');
    }
}
