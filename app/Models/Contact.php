<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['phone', 'email', 'mobile', 'person_id'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
