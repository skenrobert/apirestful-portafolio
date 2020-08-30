<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAuditShiftController extends ApiController
{
    
    // public function index(Company $company)
    // {

    // foreach ($company->productionmaster as $productionmaster) {// m a n
    //     foreach ($productionmaster->productiondetailsweek as $productiondetailsweek) {// m a n
    //         $productiondetailsweek->shifthasplanning;

    //         foreach ($productiondetailsweek->productiondetailsdays as $productiondetailsdays) {// m a n
    //             foreach ($productiondetailsdays->productiondetailsshift as $productiondetailsshift) {// m a n
    //                 // $productiondetailsshift->productiondetailsconnec;
    //                 $productiondetailsshift->productiondetailsconnec->audistsshift;
    //             }
    //         }
    //     }
    // }
    
    //     $data = ['data'=>$company];
    //     return $this->showAll($data);
    // }


    public function index(Company $company)
    {
        $auditshift = $company->accounts()
        ->whereHas('accountproductiondetails')
        // ->with('accountproductiondetails')
        ->with('accountproductiondetails.production_details_connec.auditshift')
        ->with('site')
        ->with('provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('accountproductiondetails')

        ->unique()
        ->values();

        $data = ['data'=>$auditshift];
        return $this->showAll($data);
     
    }

    
}
