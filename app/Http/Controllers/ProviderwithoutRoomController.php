<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Provider;

use Illuminate\Http\Request;

class ProviderwithoutRoomController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Request $request, $id)
    {
        $company= Company::find($id);

        $provider = $company->shifthasplanning()//TODO: debeser por planificacion especifica
        ->whereHas('planningprovider.room')
        ->where('id','=',$request->shifthasplanning_id)
        ->with('planningprovider.provider')
        ->orderBy('id','ASC')
        ->get()
        ->pluck('planningprovider')
        ->collapse()
        ->pluck('provider')
        ->pluck('id')
        ->unique()
        ->values()
        ->toArray();

        // dd($provider);

        $provider_without = $company->people()
        ->whereHas('provider')
        ->with('provider')
        ->orderBy('id','ASC')
        ->get()
        ->pluck('provider')
        // ->where('id','!=',$provider)
        ->pluck('id')
        ->unique()
        ->values()
        ->toArray();

        $provider_without = array_diff($provider_without, $provider);
        $provider_without = Provider::find($provider_without);

        $provider_without->each(function($provider_without){
                    $provider_without->person;
        });

        // $data = ['data'=>$provider,'data1'=>$provider_without];
        $data = ['data'=>$provider_without];
        return $this->showAll($data);
    }

}
