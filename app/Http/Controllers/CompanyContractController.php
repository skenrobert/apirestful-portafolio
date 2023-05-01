<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyContractController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {

        $contract = $company->contract()
        // ->whereHas('events')
        // ->with('eventType')
        ->orderBy('id','DESC')
        ->get()
        // ->where('event_type_id','!=',1)
        // ->pluck('event')
        // ->collapse()
        ->unique()
        ->values();

        $data = ['data'=>$contract];
        return $this->showAll($data);

    }
}
