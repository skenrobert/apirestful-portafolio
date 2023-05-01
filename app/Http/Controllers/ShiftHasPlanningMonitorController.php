<?php

namespace App\Http\Controllers;

use App\Models\ShiftHasPlanning;
use Illuminate\Http\Request;

class ShiftHasPlanningMonitorController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    // por monitor y por planificacion
    // public function index(Request $request,ShiftHasPlanning $shifthasplanning)
    // {
    //     $shift_id = 3;
    //     // dd($shifthasplanning);
    //     $id = $shifthasplanning->production_master()
    //     ->with('productiondetailsday.production_details_shift')
    //     ->orderBy('id','DESC')
    //     ->get()
    //     // ->where('productiondetailsday.production_details_shift.shift_id','=',$shift_id)

    //     ->pluck('productiondetailsday')
    //     ->collapse()
    //     ->pluck('production_details_shift')
    //     ->collapse()
    //     ->where('shift_id','=',$shift_id)
    //     // ->pluck('id')
    //     ->unique()
    //     ->values();

    //     $data = ['data'=>$id];
    //     return $this->showAll($data);
    // }

    public function index(Request $request,ShiftHasPlanning $shifthasplanning)
    {
        // dd($request->monitor_id);
        // $monitor = $shifthasplanning->planningprovider()
        $monitor = $shifthasplanning->monitorshift()
        //  ->where('monitor_id','=')
        ->with('monitor.person')
        ->with('planningprovider.model.person')
        // ->with('model.person')
        ->with('planningprovider.room')
        ->orderBy('id','DESC')
        ->get()

        //  ->pluck($table)
        // ->collapse()
        ->where('monitor_id','=',$request->id)
        // ->pluck('model')
        ->unique()
        ->values();

        $data = ['data'=>$monitor];
        return $this->showAll($data);
    }
   //auth()->id()
   
}
