<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyTaskController extends ApiController
{
    
    public function index(Company $company)
    {
        $providers = $company->task()
        //  ->whereHas('task')
        // ->with('task')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$providers];
        return $this->showAll($data);
    }
    
}
