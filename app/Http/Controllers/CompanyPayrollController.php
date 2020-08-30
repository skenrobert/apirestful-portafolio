<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyPayrollController extends ApiController
{
    public function index(Company $company)
    {
        $payroll = $company->people()
        //  ->whereHas('providers')
        ->with('employee.payroll')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$payroll];
        return $this->showAll($data);
    }
}
