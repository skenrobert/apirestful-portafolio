<?php

namespace App\Http\Controllers;

use App\Models\ComissionEmployee;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyComissionEmployeeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $comissionemployees = $company->productionmaster()
         ->whereHas('events')
        ->with('events.comissionemployees')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$comissionemployees];
        return $this->showAll($data);
    }

    public function show(Company $company, $id)
    {
        $comissionemployees = $company->productionmaster()
         ->whereHas('events')
        ->with('events.comissionemployees')
        ->orderBy('id','DESC')
        ->get()
        ->where('id','=',$id)
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$comissionemployees];
        return $this->showOne($data);
    }
}
