<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyTypeMovementInventoryController extends ApiController
{

    public function index(Request $request, Company $company)
    {
        $typemovementinventory = $company->shops()
         ->whereHas('inventory')
        ->with('inventory.typemovementinventory')
        ->orderBy('id','DESC')
        ->get()
        ->where('id','=',$request->shop)
        ->unique()
        ->values();

        $data = ['data'=>$typemovementinventory];
        return $this->showAll($data);
    }

}
