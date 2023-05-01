<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $accounts = $company->accounts()
        ->orderBy('id','DESC')
        ->get()
        ->unique()
        ->values();


        $accounts->each(function($accounts){//1 a m
            $accounts->user->person;
            $accounts->site;
         });

        $data = ['data'=>$accounts];
        return $this->showAll($data);
    }

    // public function index(Company $company)
    // {
    //     $provider = $company->people()
    //     ->whereHas('provider')
    //     ->with('user')
    //     ->with('provider.accounts.site')
    //     ->orderBy('id','DESC')
    //     ->get()
    //     // ->pluck('provider')
    //     ->unique()
    //     ->values();

    //     $data = ['data'=>$provider];
    //     return $this->showAll($data);
    // }

}
