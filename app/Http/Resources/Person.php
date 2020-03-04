<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Person extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'contact' => [
                'phone' => $this->contact ? $this->contact->phone : '',
                'email' => $this->contact ? $this->contact->email : '',
                'mobile' => $this->contact ? $this->contact->mobile : ''
            ],
            'address' => [
                'cep' => $this->address ? $this->address->cep : '',
                'street' => $this->address ? $this->address->street : '',
                'district' => $this->address ? $this->address->district : '',
                'city' => $this->address ? $this->address->city : '',
                'state' => $this->address ? $this->address->state : ''
            ],
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'cpf' => $this->cpf
        ];
    }
}
