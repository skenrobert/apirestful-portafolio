<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAuditController extends ApiController
{
    public function index(Company $company)
    {
        $audits = $company->productionmaster()
        // ->whereHas('accountproductiondetails')
        // ->with('productiondetailsdays')
        ->with('audits')
        // ->with('commission')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('productiondetailsconnec')
        ->unique()
        ->values();

        $data = ['data'=>$audits];
        return $this->showAll($data);
    }
}
