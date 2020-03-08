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
use App\Http\Interfaces\IPersonCreation;
use App\Http\Interfaces\IPersonUpdate;
use App\Http\Interfaces\IPersonDelete;
use App\Http\Interfaces\IPersonFind;


class PersonController extends Controller
{
    private $personCreation;
    private $personUpdate;
    private $personDelete;

    public function __construct(
        IPersonCreation $personCreation, 
        IPersonUpdate $personUpdate, 
        IPersonFind $personFind,
        IPersonDelete $personDelete
    ) {
        $this->personCreation = $personCreation; 
        $this->personUpdate = $personUpdate;
        $this->personDelete = $personDelete;
        $this->personFind = $personFind;
    }

    public function index(Request $request)
    {
        if ($request->has('cpf')) {
            $person = Person::where('cpf', $request->input('cpf'))->first();
            if (is_null($person)) {
                return response()->json(["message" => "Person not found"], 404);
            }
            return new PersonResource($person);
        }        
        return new PersonCollection(Person::orderBy('first_name', 'ASC')->paginate());
    }


    public function show($id)
    {
        $person = $this->personFind->execute($id);
        return new PersonResource($person);
    }    


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $person = $this->personCreation->execute($request);

        $contact = new Contact();
        $contact->person_id = $person->id;
        $contact->phone = $request->contact['phone'];
        $contact->email = $request->contact['email'];
        $contact->mobile = $request->contact['mobile'];
        $contact->save();

        $address = new Address();
        $address->person_id = $person->id;
        $address->setEndereco($request->address['cep']);
        $address->save();

        return new PersonResource($person);
    }


    public function update(Request $request, int $id)  
    {
        $validator = Validator::make($request->all(), $this->validationRules('put'));
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $person = $this->personUpdate->execute($request, $id);

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
        $this->personDelete->execute($id);
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
