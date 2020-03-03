<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\Person as PersonResource;
use App\Models\Person;
use App\Models\Contact;
use App\Models\Address;

class PersonController extends Controller
{
    public function index()
    {
        return new PersonCollection(Person::orderBy('first_name', 'ASC')->paginate());
    }


    public function show($id)
    {
        $person = Person::findOrFail($id); 
        return new PersonResource($person);
    }    


    public function store(Request $request)
    {
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

}
