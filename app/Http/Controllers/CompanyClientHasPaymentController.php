<?php

namespace App\Http\Controllers;

use App\Models\ClientHasPayment;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyClientHasPaymentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $clienthaspayment = $company->people()
         ->whereHas('clienthaspayment')
        ->with('clienthaspayment.bill_to_charge')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$clienthaspayment];
        return $this->showAll($data);
    }

   
}
