<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyProductionDetailsConnecController extends ApiController
{
    public function index(Company $company)
    {

    foreach ($company->productionmaster as $productionmaster) {// m a n
        foreach ($productionmaster->productiondetailsweek as $productiondetailsweek) {// m a n
            $productiondetailsweek->shifthasplanning;

            foreach ($productiondetailsweek->productiondetailsdays as $productiondetailsdays) {// m a n
                foreach ($productiondetailsdays->productiondetailsshift as $productiondetailsshift) {// m a n
                    $productiondetailsshift->productiondetailsconnec;
                }
            }
        }
    }
    
        $data = ['data'=>$company];
        return $this->showAll($data);
    }

   
}
