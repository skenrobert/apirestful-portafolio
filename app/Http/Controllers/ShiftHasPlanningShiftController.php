<?php

namespace App\Http\Controllers;

use App\Models\ShiftHasPlanning;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftHasPlanningShiftController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }

    public function index(ShiftHasPlanning $shifthasplanning)
    {
        $monitorshift = $shifthasplanning->monitorshift()
        ->with('shift')
        ->with('monitor.person')
        ->with('planningprovider')
        ->with('task')
        ->orderBy('shift_id','DESC')
        ->get()
        ->unique()
        ->values();

        $data = ['data'=>$monitorshift];
        return $this->showOne($data);
    }

    public function show(ShiftHasPlanning $shifthasplanning, $id)
    {

        // $monitorshift = $shifthasplanning->monitorshift()
        // // ->whereHas('shift')
        // ->with('shift')
        // ->with('user.person')
        // ->with('task')
        // ->orderBy('id','DESC')
        // ->get()
        // ->where('shift_id', '=', $id)
        // ->unique()
        // ->values();


        $planningprovider = $shifthasplanning->monitorshift()
        // ->whereHas('shift')
        ->with('shift')
        ->with('monitor.person')
        ->with('task')
        ->with('planningprovider.model')
        ->orderBy('id','DESC')
        ->get()
        ->where('shift_id', '=', $id)

        // ->pluck('model')
        // ->pluck('id')
        ->unique()
        ->values();
        // ->toArray();
        

        // $longitud = count($planningprovider);

        // $monitorshift->observation = $longitud;

        $data = ['data'=>$planningprovider];
        // $data = ['data'=>$monitorshift, 'data1'=>$longitud];
        return $this->showOne($data);

    }

   
}
