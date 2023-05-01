<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CompanyEventController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {

        $event = $company->events()
        // ->whereHas('events')
        // ->with('eventType')
        ->orderBy('id','DESC')
        ->get()
        ->where('event_type_id','!=',1)
        // ->pluck('event')
        // ->collapse()
        ->unique()
        ->values();

        $data = ['data'=>$event];
        return $this->showAll($data);

    }

    public function show(Request $request, Company $company, $id)
    {

        //auth()->guard('api')->user()
      //  auth('api')->user()

        dd(auth('api')->user());
        $users= User::where('id','=',$id)->get();

                    foreach ($users as $user) {// m a n
                       $variable = $user->roles[0]->name;
                    }
             
        if($variable = 'Modelo'){


            $eventAlert = $company->events()
            // ->whereHas('event')
            // ->with('event.user')
            ->with('model.person')
            ->orderBy('id','DESC')
            ->get()
            // ->pluck('event')
            // ->collapse()
            ->where('event_type_id','=', 1)
            ->where('model_id','=', $id)
            
            ->unique()
            ->values();

        }else{

            $eventAlert = $company->events()
            // ->whereHas('event')
            ->with('user.person')
            // ->with('event.model')
            ->orderBy('id','DESC')
            ->get()
            // ->pluck('event')
            // ->collapse()
            ->where('event_type_id','=', 1)
            ->where('user_id','=', $id)
            
            ->unique()
            ->values();
        }

        $data = ['data'=>$eventAlert];
        return $this->showAll($data);

    }


    public function companyAlert(Request $request, Company $company)
    {

            $eventAlert = $company->events()
            // ->whereHas('event')
            // ->with('user.company')
            // ->with('event.model')
            ->orderBy('id','DESC')
            ->get()
            // ->pluck('event')
            // ->collapse()
            ->where('event_type_id','=', 1)
            ->unique()
            ->values();

        $data = ['data'=>$eventAlert];
        return $this->showAll($data);

    }
}
