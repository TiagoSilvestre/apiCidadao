<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	
  public function address()
  {
    return $this->hasOne('App\Models\Address');
  }

  public function contact()
  {
    return $this->hasOne('App\Models\Contact');
  }  
}
