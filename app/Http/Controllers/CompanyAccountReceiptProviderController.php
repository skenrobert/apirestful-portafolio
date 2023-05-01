<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountReceiptProviderController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $accountreceiptproviders = $company->accountreceiptproviders()
        ->orderBy('id','DESC')
        ->get()
        ->unique()
        ->values();


        // $accounts->each(function($accounts){//1 a m
        //     $accounts->provider->person;
        //     $accounts->site;
        //  });

        $data = ['data'=>$accountreceiptproviders];
        return $this->showAll($data);
    }
}
