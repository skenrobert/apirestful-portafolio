<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Room;
use Illuminate\Http\Request;

class CompanyunassignedRoomsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function update(Request $request,  $id)
    {

        $company= Company::find($id);

        $shifthasplanning = $company->shifthasplanning()
        ->whereHas('monitorshift.planningprovider')
        ->with('monitorshift.planningprovider')
        ->get()

        ->pluck('monitorshift')
        ->collapse()
        ->where('shift_has_planning_id','=',$request->shift_has_planning_id)
        ->pluck('planningprovider')
        ->collapse()

        // ->pluck('planningprovider')
        // ->collapse()
        // ->where('shift_has_planning_id','=',$request->shift_has_planning_id)
        ->pluck('room_id')
        ->unique()
        ->values()
        ->toArray();

        $rooms = $company->room()
        //  ->whereHas('providers')
        // ->with('provider')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('id')
        ->unique()
        ->values()
        ->toArray();


        $resultado = array_diff($rooms, $shifthasplanning);

        $rooms= Room::find($resultado);

        $data = ['data'=>$rooms];
        // $data = ['data'=>$rooms, 'data1'=>$shifthasplanning, 'data2'=>$resultado];

        return $this->showAll($data);
    }

}
