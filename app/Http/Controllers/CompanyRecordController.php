<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyRecordController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $record = $company->records()
        //  ->whereHas('providers')
        ->with('trainings')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$record];
        return $this->showAll($data);
    }

    public function update(Request $request, Company $company, Boutique $boutique)
    {

        // $boutique->providers()->syncWithoutDetaching($request->provider_id, ['observations' => $request->observations,'replacement_value' => $request->replacement_value,'monitor_id' => $request->monitor_id]);
       
        // $boutique->providers;

        // return $this->showAll($boutique);

    }


    public function destroy(Request $request, Company $company, Boutique $boutique)
    {
        // if(!$company->boutique()->find($request->provider_id))
        // {
        //     return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
        // }

        // $boutique->providers()->detach($request->provider_id);
        // // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
        // $boutique->providers;
        // return $this->showAll($boutique);
    }
}
