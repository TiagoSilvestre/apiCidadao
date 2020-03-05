<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\Person as PersonResource;
use App\Models\Person;
use App\Models\Contact;
use App\Models\Address;
use Validator;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cpf')) {
            $person = Person::where('cpf', $request->input('cpf'))->first();
            if (is_null($person)) {
                return response()->json(["message" => "Pessoa não encontrada"], 404);
            }
            return new PersonResource($person);
        }        
        return new PersonCollection(Person::orderBy('first_name', 'ASC')->paginate());
    }


    public function show($id)
    {
        $person = Person::findOrFail($id);
        return new PersonResource($person);
    }    


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $person = Person::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cpf' => $request->cpf
        ]);

        $contact = Contact::create([
            'person_id' => $person->id,
            'phone' => $request->contact['phone'],
            'email' => $request->contact['email'],
            'mobile' => $request->contact['mobile']
        ]);

        $address = new Address();
        $address->person_id = $person->id;
        $address->setEndereco($request->address['cep']);
        
        $person->address()->save($address);

        return new PersonResource($person);
    }


    public function update(Request $request, int $id)  
    {
        $person = Person::findOrFail($id);
        if (is_null($person)) {
            return response()->json(["message" => "Pessoa não encontrada"], 404);
        }

        $validator = Validator::make($request->all(), $this->validationRules('put'));
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $person->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cpf' => $request->cpf      
        ]);

        $contact = Contact::where('person_id', $id)->firstOrFail();
        $contact->phone = $request->contact['phone'];
        $contact->email = $request->contact['email'];
        $contact->mobile = $request->contact['mobile'];
        $contact->save();

        $address = Address::where('person_id', $id)->firstOrFail();
        $address->setEndereco($request->address['cep']);
        $address->save();

        return new PersonResource($person);
    } 


    public function destroy(int $id)    
    {
        $person = Person::findOrFail($id);
        $person->delete();
        return response()->json(null, 204);
    }


    public function validationRules($method = '')    
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'cpf' => 'required|unique:people,cpf',
            'address.cep' => 'required|digits:8',
            'contact.phone' => 'required',
            'contact.email' => 'required|email',
            'contact.mobile' => 'required'
        ];    
        if ($method == 'put') {
            unset($rules['cpf']);
        }        
        return $rules;
    }
}
