<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyProductionMasterController extends ApiController
{
    public function index(Company $company)
    {
        $productionmaster = $company->productionmaster()
        // ->whereHas('accountproductiondetails')
        ->with('productiondetailsdays')
        // ->with('site')
        ->with('commission')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('productiondetailsconnec')
        ->unique()
        ->values();

        $data = ['data'=>$productionmaster];
        return $this->showAll($data);
    }

    public function show(Company $company)
    {
        //
    }

    public function update(Request $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }


}
