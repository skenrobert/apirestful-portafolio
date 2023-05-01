<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShiftHasPlanning;
use Carbon\Carbon;


use Illuminate\Http\Request;

class CompanyShiftHasPlanningController extends ApiController
{
   
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }


    public function index(Company $company)
    {
        $shifthasplannings = $company->shifthasplanning()
        // ->whereHas('shift')
        // ->with('shift')
        ->orderBy('id','DESC')
        ->get()
        ->unique()
        ->values();

            $shifthasplannings->each(function($shifthasplannings){
                $shifthasplannings->monitorshift;
                $shifthasplannings->planningprovider;
    
              });


        $data = ['data'=>$shifthasplannings];
        // $data = $shifthasplannings;
        return $this->showAll($data);
    }

}
