<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Person;
use App\Models\Provider;
use Illuminate\Http\Request;

class CompanyProviderController extends ApiController
{
    
    public function index(Company $company)
    {
       
        $providers = $company->people()
        ->whereHas('Provider')
        ->with('Provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$providers];
        return $this->showAll($data);
    }

   
    public function update(Request $request, Company $company, Provider $provider)
    {
        
        $company->people()->syncWithoutDetaching([$provider->person_id]);
        $company->people;
        // $data = ['data'=>$company];
        // return $this->showAll($data);
        return $this->showAll($company);

    }

    public function destroy(Company $company, Provider $provider)
    {
         //se elimina la relación en la tabla pivote

        //TODO: debe eliminar de la tabla empleado el registro
        if(!$company->people()->find($provider->person_id))
        {
            return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
        }

        $company->people()->detach($provider->person_id);
        // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
        $company->people;
        return $this->showAll($company);

    }
}
