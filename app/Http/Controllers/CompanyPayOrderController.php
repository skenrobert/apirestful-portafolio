<?php

namespace App\Http\Controllers;

use App\Models\PayOrder;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyPayOrderController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $billtopay = $company->accounting()
        //  ->whereHas('providers')
        ->with('billtopay.payorders')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$billtopay];
        return $this->showAll($data);
    }
}
