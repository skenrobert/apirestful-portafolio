<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyShopController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
   
    public function index(Company $company)
    {
        $shops = $company->shops()
        //  ->whereHas('shops')
        // ->with('shops')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$shops];
        return $this->showAll($data);
    }

}
