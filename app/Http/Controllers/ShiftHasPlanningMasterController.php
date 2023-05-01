<?php

namespace App\Http\Controllers;

use App\Models\ShiftHasPlanning;
use Illuminate\Http\Request;

class ShiftHasPlanningMasterController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Request $request,ShiftHasPlanning $shifthasplanning)
    {
        // dd($request->id);
        $productionmaster = $shifthasplanning->production_master()
        // $monitor = $shifthasplanning->monitorshift()
        //  ->whereHas('monitor')
        ->with('commission')
        // ->with('commission_employed_payment')
        // ->with('room')
        ->orderBy('id','DESC')
        ->get()

        //  ->pluck($table)
        // ->collapse()
        // ->where('monitor_id','=',$request->id)
        // ->pluck('model')
        ->unique()
        ->values();

        $data = ['data'=>$productionmaster];
        return $this->showAll($data);
    }
   
}
