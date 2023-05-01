<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyStoreController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $stores = $company->stores()
        //  ->whereHas('task')
        // ->with('task')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$stores];
        return $this->showAll($data);
    }
}
