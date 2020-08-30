<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountRequestController extends ApiController
{

    public function index(Company $company)
    {
        $accountrequest = $company->accountrequest()
        //  ->whereHas('providers')
        ->with('account')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$accountrequest];
        return $this->showAll($data);
    }

}
