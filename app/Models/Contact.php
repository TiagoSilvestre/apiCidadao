<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
