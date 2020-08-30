<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyRoomController extends ApiController
{
    
    public function __construct()//TODO: se deshabilita para probar el json
    {
        // $this->middleware('auth:api');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }
    
    public function index(Company $company)
    {
        $providers = $company->room()
        //  ->whereHas('providers')
        // ->with('provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$providers];
        return $this->showAll($data);
    }

    public function update(Request $request, Company $company, Locker $locker)
    {
        // $company->locker()->syncWithoutDetaching([$request->provider_id]);
        // $company->locker;

        // dd($request->id);

        // $locker->providers()->sync([$request->provider_id]);
        // $locker->providers;

        // // $data = ['data'=>$company];
        // // return $this->showAll($data);
        // return $this->showAll($locker);
    }


//     public function destroy(Request $request, Company $company)
//     {
//         if(!$company->locker()->find($request->provider_id))
//         {
//             return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
//         }

//         $locker->providers()->detach($request->provider_id);
//         // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
//         $locker->providers;
//         return $this->showAll($locker);
//     }
}
