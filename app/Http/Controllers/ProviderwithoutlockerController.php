<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Provider;
use App\Models\Locker;
use Illuminate\Http\Request;

class ProviderwithoutlockerController extends ApiController
{
   
    public function index($id)
    {

        $company= Company::find($id);

        $provider = $company->people()
        ->whereHas('provider')
        ->with('provider')
        ->get()
        ->pluck('provider')
        ->unique()
        ->values();

        //TODO: para saber que locker estan desocupados
        // $provider = Provider::doesntHave('lockers')->get();
        // $provider = $company->locker()
        // ->doesntHave('provider')
        // ->with('locker')
        // ->get()
        // ->pluck('provider')
        
        // ->where('pivot','=',null)

        // ->collapse('pivot')
        // ->pluck('pivot')

        // ->unique()
        // ->values();
          
        $provider->each(function($provider){
            $provider->lockers;
            $provider->person->user;
            $provider->jobtype;
        });

       // SQL: select `pivot` from `lockers` inner join `locker_provider` on `lockers`.`id` = `locker_provider`.`locker_id` where `locker_provider`.`provider_id` = 1 and `lockers`.`deleted_at` is null)

        // $provider->lockers()->detach($locker->id);
        // return $this->showAll($provider->doesntHave('lockers')->get());
        $data = ['data'=>$provider];
        return $this->showAll($data);

    }

  
}
