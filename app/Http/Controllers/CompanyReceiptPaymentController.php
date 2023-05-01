<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyReceiptPaymentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
       
        $providers = $company->people()
        // ->whereHas('Provider')
        ->with('employee.payroll.receiptpayments')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$providers];
        return $this->showAll($data);
    }

}
