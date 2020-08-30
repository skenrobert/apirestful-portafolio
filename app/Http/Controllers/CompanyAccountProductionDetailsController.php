<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountProductionDetailsController extends ApiController
{
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
}
