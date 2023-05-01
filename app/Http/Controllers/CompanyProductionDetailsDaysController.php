<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyProductionDetailsDaysController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {

    foreach ($company->productionmaster as $productionmaster) {// m a n
        foreach ($productionmaster->productiondetailsweek as $productiondetailsweek) {// m a n
                    $productiondetailsweek->productiondetailsdays;
                    $productiondetailsweek->shifthasplanning;
        }
    }
    
        $data = ['data'=>$company];
        return $this->showAll($data);
    }

   
}
