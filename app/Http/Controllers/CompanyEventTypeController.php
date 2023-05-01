<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyEventTypeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {

        $eventType = $company->eventType()
        // ->whereHas('user')
        // ->with('employee')
        // ->with('user')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('employee')
        ->unique()
        ->values();

        $data = ['data'=>$eventType];
        return $this->showAll($data);

    }

}
