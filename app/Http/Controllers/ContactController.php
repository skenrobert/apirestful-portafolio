<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends ApiController
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth:api');
    }
   
    public function index()
    {
       
        $contacts= Contact::orderBy('id','DESC')->get();

        $data = ['data'=>$contacts];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());
        return $this->showOne($contact, 201);
        
    }

    public function show(Contact $contact)
    {
        $data = ['data'=>$contact];
        return $this->showOne($data);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->fill($request->all())->save();
        return $this->showOne($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete($contact);
        return $this->showOne($contact);
    }


}
