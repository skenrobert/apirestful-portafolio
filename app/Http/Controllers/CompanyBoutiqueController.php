<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Boutique;
use Illuminate\Http\Request;

class CompanyBoutiqueController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $providers = $company->boutique()
        //  ->whereHas('providers')
        ->with('provider.person')
        ->orderBy('id','DESC')
        ->get()
        // ->where('status','1')
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$providers];
        return $this->showAll($data);
    }

    public function update(Request $request, Company $company, Boutique $boutique)// tres status 
    {
        // dd($request->monitor_id);

        // $boutique->providers()->syncWithoutDetaching($request->provider_id, ['observations' => $request->observations,'replacement_value' => $request->replacement_value,'monitor_id' => $request->monitor_id]);
        $boutique->providers()->attach($request->provider_id, ['observations' => $request->observations,'replacement_value' => $request->replacement_value,'monitor_id' => $request->monitor_id]);
       
        $boutique->status = 0;
        $boutique->save();
        $boutique->provider->person;

        $data = ['data'=>$boutique];
        return $this->showOne($boutique);

    }


    public function destroy(Request $request, Company $company, Boutique $boutique)
    {
        if(!$company->boutique()->find($request->provider_id))
        {
            return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
        }

        $boutique->providers()->detach($request->provider_id);
        // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot

        $boutique->status = 1;
        $boutique->save();

        $boutique->provider->person;

        $data = ['data'=>$boutique];
        return $this->showOne($boutique);
    }
}
