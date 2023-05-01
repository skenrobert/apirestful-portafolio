<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\AccountProductionDetails;
use App\Models\USer;
use Illuminate\Http\Request;

class CompanyAccountProductionDetailsController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $accounts = $company->accounts()
        // ->whereHas('accountproductiondetails')
        ->with('accountproductiondetails')
        ->with('site')
        ->with('provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('productiondetailsconnec')
        ->unique()
        ->values();

        $data = ['data'=>$accounts];
        return $this->showAll($data);
     
    }

    public function show(Request $request, Company $company, $shifthasplanning_id)
    {

        $accounts = $company->shifthasplanning()
        ->with('monitorshift.productiondetailsshift.productiondetailsconnec.accountproductiondetails.account.site')
        ->orderBy('id','DESC')
        ->get()
        ->where('id','=', $shifthasplanning_id)
        ->pluck('monitorshift')
        ->collapse()
        ->where('monitor_id','=', $request->monitor_id)
        ->pluck('productiondetailsshift')
        ->collapse()

        ->unique()
        ->values();

        $data = ['data'=>$accounts];
        return $this->showAll($data);
     
    }

}
