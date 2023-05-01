<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Provider;
use App\Models\Employee;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\PeopleRequest;

use Illuminate\Support\Facades\Validator;


// use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Traits\HasRoles;

class PersonController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Personas"]
    //     ];

    //     $people = Person::orderBy('id','DESC')->get();
    //     $people->each(function($people){
    //         $people->user;
    //         $people->companies;
    //         $people->bank;
    //         $people->eps;
    //     });

    //     $data = ['data'=>$people, 'breadcrumbs'=> $breadcrumbs];

    //     // return response()->json($people, 200);

    //     return $this->showAll($data);

    // }

    public function store(PeopleRequest $request)
    {

        if($request->role_id != ""){
            $user = new User();

                if($request->has('email')){
                    $user->email = $request->email;
                }

                if($request->has('password')){
                    $user->password = bcrypt($request->password);// encripta la clave
                }

                if($request->has('notification_preference')){
                    $user->notification_preference = $request->notification_preference;

                }

                if($request->has('company_id')){
                    $user->company_id = $request->company_id;
                }

                $person = new Person($request->all());
                $person->save();

                $person->companies()->syncWithoutDetaching($request->company_id);//sincroniza el roll

                if($request->has('jobtype_id')){

                    if($request->jobtype_id == 2 or $request->jobtype_id == 3 or $request->jobtype_id == 4 or $request->jobtype_id == 5 or $request->jobtype_id == 6){
                            $provider = new Provider();
                            $provider->person_id = $person->id;
                            $provider->jobtype_id = $request->jobtype_id;
                            $provider->init = $request->init;
                            $provider->save();

                    }else{

                            $employee = new Employee();
                            $employee->person_id = $person->id;
                            $employee->jobtype_id = $request->jobtype_id;
                            $employee->init = $request->init;
                            $employee->save();
                    }
                }
                
                $user->person_id = $person->id;
                $user->slug = $user->email;
                $user->save();
                $user->roles()->sync($request->role_id);

                $real = User::find($user->id);

                $real->person;
                $real->roles;
                $real->company->companytype;

        }

        $data = ['data'=>$real];
        return $this->showOne($data);

    }

    public function show(Person $person)
    {

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Persona"]
        ];

        $person->user;
        $person->banks;
        $person->epss;

        $data = ['data'=>$person, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);

    }

    
    public function update(PeopleRequest $request, Person $person)//el metodo es put para actualizar, crear en la base de datos de post
    {
        if($person->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $person->fill($request->all());
        $person->save();
        $person->companies()->syncWithoutDetaching($request->company_id);//sincroniza 
        $person->companies;

        // if($request->has('epss_id')){
        //     $person->epss_id = $request->epss_id;
        // }

        // if($request->has('banks_id')){
        //     $person->banks_id = $request->banks_id;
        // }
        $data = ['data'=>$person];
        return $this->showOne($data);
    }

    // public function destroy(Person $person)
    // {
    //     $person->delete($person);
    //     return $this->showOne($person);
    // }

    //***************************************************************************** */
    
    public function onlyperson(PeopleRequest $request){ 
        $person = new Person($request->all());
        $person->save();

        $person->companies()->syncWithoutDetaching($request->company_id);
        $person->companies;

        if($request->has('epss_id')){
            $person->epss_id = $request->epss_id;
        }

        if($request->has('banks_id')){
            $person->banks_id = $request->banks_id;
        }
        
        if($request->has('jobtype_id')){

            if($request->jobtype_id == 2 or $request->jobtype_id == 3 or $request->jobtype_id == 4 or $request->jobtype_id == 5 or $request->jobtype_id == 6){
                    $provider = new Provider();
                    $provider->person_id = $person->id;
                    $provider->jobtype_id = $request->jobtype_id;
                    $provider->init = $request->init;
                    $provider->save();

            }else{

                    $employee = new Employee();
                    $employee->person_id = $person->id;
                    $employee->jobtype_id = $request->jobtype_id;
                    $employee->init = $request->init;
                    $employee->save();
            }
        }

        $data = ['data'=>$person];
        return $this->showOne($data);


        }



    //***************************************************************************** */

    
    // public function getAll(){ //metodo similar al index
    //     $people = Person::all();
       
    //      return $people;

    // }

    // public function add(Request $request){// alternativa del store
    //     $person = Person::create($request->all());
    //     return $person;

    // }

    // public function get($id){// no hace falta el find con el metodo show por el pase de la variable
    //    //$person = DB::table('person')->where('person.id', $branch_id)->get();

    //     $person = Person::find($id);
    //     return $person;

    // }

    // public function edit($id, Request $request){ //otro tipo de update
    //     $person = $this->get($id);
    //     $person->fill($request->all())->save();
    //     return $person;


    // }

}
