<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['cep', 'street', 'district', 'city', 'state', 'person_id'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function setEndereco($cep)
    {
        $retornoCorreios = $this->consultaCepCorreios($cep);       
        
        $this->cep = $cep;
        $this->street = $retornoCorreios->logradouro;
        $this->district = $retornoCorreios->bairro;
        $this->city = $retornoCorreios->localidade;
        $this->state = $retornoCorreios->uf;        
    }

    public function consultaCepCorreios($cep)
    {
        $url = "http://viacep.com.br/ws/$cep/json/";
        return json_decode(file_get_contents($url));
    }

}
