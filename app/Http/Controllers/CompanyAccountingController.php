<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountingController extends ApiController
{
    public function index(Company $company)
    {
        $accounting = $company->accounting()
        //  ->whereHas('providers')
        ->with('accountplan')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$accounting];
        return $this->showAll($data);
    }
}
