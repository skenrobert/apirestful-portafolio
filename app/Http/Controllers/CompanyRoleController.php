<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Employee;
use App\Models\ShiftHasPlanning;
// use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CompanyRoleController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Request $request)
    {

        $company= Company::find($request->company_id);

        $users = $company->user()
        ->whereHas('roles')
        ->with('roles')
        ->get()
        ->where('status','=', true)
        ->pluck('roles')
        ->collapse()
        ->where('name','=',$request->name)
        ->pluck('pivot')
        ->pluck('user_id')
        ->unique()
        ->values()
        ->toArray();

        $longitud = count($users);

        if( $longitud >= 1){


            $users= User::find($users);

                $users->each(function($users){//1 a 1

                    foreach ($users->roles as $role) {// m a n
                        $role->pivot->created_at;
                    }

                    $users->person;
                });
        

        }elseif ($longitud =='') {
            return response()->json(['error' => 'No existen Usuario '.$request->name , 'code' => 422], 422);

        }


        $data = ['data'=>$users];
        return $this->showAll($data);
    }


    public function update(Request $request,  $id)
    {

        $company= Company::find($id);

        if($request->name == 'Modelo'){

            $table = 'monitorshift.planningprovider';
            $user_id = 'model_id';

            $shifthasplanning = $company->shifthasplanning()
            ->whereHas($table)
            ->with($table)
            ->orderBy('id','DESC')
            ->get()
            ->pluck('monitorshift')
            ->collapse()
            ->where('shift_has_planning_id','=',$request->shift_has_planning_id)
            ->pluck('planningprovider')
            ->collapse()
            ->pluck($user_id)
            ->unique()
            ->values()
            ->toArray();

        }else if($request->name == 'Monitor'){

            $table = 'monitorshift';
            $user_id = 'monitor_id';

            $shifthasplanning = $company->shifthasplanning()
            ->whereHas($table)
            ->with($table)
            ->orderBy('id','DESC')
            ->get()
            ->pluck($table)
            ->collapse()
            ->where('shift_has_planning_id','=',$request->shift_has_planning_id)
            ->pluck($user_id)
            ->unique()
            ->values()
            ->toArray();

        }

        // dd($table);

        

        $users = $company->user()
        ->whereHas('roles')
        ->with('roles')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('roles')
        ->collapse()
        ->where('name','=',$request->name)
        ->pluck('pivot')
        ->pluck('user_id')
        ->unique()
        ->values()
        ->toArray();


        $longitud1 = count($shifthasplanning);
        $longitud = count($users);


        if($longitud1 >= 1 && $longitud >= 1){

            $resultado = array_diff($users, $shifthasplanning);

            $users= User::find($resultado);

                $users->each(function($users){//1 a 1

                    foreach ($users->roles as $role) {// m a n
                        $role->pivot->created_at;
                    }

                    $users->person;
                });
        

        }elseif ($longitud =='') {
            return response()->json(['error' => 'No existen Usuario Monitor', 'code' => 422], 422);


        }elseif ($longitud1 == '') {
            // dd($longitud1.'=='. 0);

            if(ShiftHasPlanning::findOrfail($request->shift_has_planning_id)){

                    $users= User::find($users);

                    $users->each(function($users){//1 a 1

                        foreach ($users->roles as $role) {// m a n
                            $role->pivot->created_at;
                        }

                        $users->person;
                        // $users->company->companytype;
                    });

            }else {

                return response()->json(['error' => 'No Existen La Planificacion '.$request->shift_has_planning_id, 'code' => 422], 422);


            }
                    
        }


        // $data = ['data'=>$users,'data1'=>$shifthasplanning];
        $data = ['data'=>$users];

        return $this->showAll($data);
    }

}
