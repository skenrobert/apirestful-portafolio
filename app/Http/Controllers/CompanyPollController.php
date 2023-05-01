<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyPollController extends Controller
{
    public function index(Company $company)
    {
        $polls = $company->polls()
        // ->whereHas('employee')
        ->with('user')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('employee')
        ->unique()
        ->values();

        $data = ['data'=>$polls];
        return $this->showAll($data);

    }
}
