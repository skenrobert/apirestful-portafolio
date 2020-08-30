<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAssistanceController extends ApiController
{
    public function index(Company $company)
    {
        $assistancecontrol = $company->people()
        // ->whereHas('employee')
        ->with('employee.assistancecontrols')
        // ->with('user')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('employee')
        ->unique()
        ->values();

        $data = ['data'=>$assistancecontrol];
        return $this->showAll($data);

    }
}
