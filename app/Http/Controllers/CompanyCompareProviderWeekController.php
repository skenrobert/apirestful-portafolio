<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCompareProviderWeekController extends ApiController
{
    public function index(Company $company)
    {

    foreach ($company->productionmaster as $productionmaster) {// m a n
        foreach ($productionmaster->productiondetailsweek as $productiondetailsweek) {// m a n
                    // $productiondetailsweek->productiondetailsdays;
                    $productiondetailsweek->compareproviderweek;
        }
    }
    
        $data = ['data'=>$company];
        return $this->showAll($data);
    }
}
