<?php

namespace App\Http\Controllers;

use App\Models\MonitorShift;
use App\Models\PlanningProvider;
use App\Models\User;
use App\Models\ShiftHasPlanning;
use App\Models\ProductionDetailsShift;
// use App\Models\ProductionDetailsShift;


use Illuminate\Http\Request;
use App\Http\Requests\MonitorShiftRequest;

use Illuminate\Support\Facades\DB;

class MonitorShiftController extends ApiController
{
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Monitores por Turno"]
        // ];
     
        // // $companies = Company::has('companytype')->get();
        // $monitorshifts= MonitorShift::orderBy('id','DESC')->get();

        // $monitorshifts->each(function($monitorshifts){
        //     $monitorshifts->task;
        //     $monitorshifts->shift;
        //     $monitorshifts->employee;

        //   });

        // $data = ['data'=>$monitorshifts, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function show(Monitorshift $monitorshift)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Detalles de Horario de Monitor"]
        ];
     
            $monitorshift->task;
            $monitorshift->shift;
            $monitorshift->shift_has_planning;
            $monitorshift->planningprovider;
            $monitorshift->monitor->person;

        $data = ['data'=>$monitorshift, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Monitorshift $monitorshift)
    {
        if($monitorshift->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }


        if($request->has('observation')){
            $monitorshift->observation = $request->observation;
        }

        if($request->has('support')){
            $monitorshift->support = $request->support;
        }

        if($request->has('sunday')){
            $monitorshift->sunday = $request->sunday;
        }

        if($request->has('shift_id')){
            $monitorshift->shift_id = $request->shift_id;
        }

        if($request->has('task_id')){
            $monitorshift->task_id = $request->task_id;
        }

        if($request->has('monitor_id')){
            $monitorshift->monitor_id = $request->monitor_id;
        }

        if($request->has('goal_dollar_monitor')){

           
            $monitorshift->goal_dollar_monitor = $request->goal_dollar_monitor;
            $monitorshift->goal_tkn_monitor = $request->goal_tkn_monitor;
            // $monitorshift->save();
            // dd($monitorshift);

            $shifthasplanning = $monitorshift->shift_has_planning;

            $sum = 0;
            $sum2 = 0;

            foreach ($shifthasplanning->monitorshift as $monitorshift1) {
                    $sum += $monitorshift1->goal_dollar_monitor;
                    $sum2 += $monitorshift1->goal_tkn_monitor;
                }

            $masterproduction = $shifthasplanning->production_master;
            $masterproduction->dolar_total_assigned += $sum;
            $masterproduction->tkn_total_assigned += $sum2;
            $masterproduction->save();
        }

        $monitorshift->save();
        $monitorshift->planningprovider;
        $monitorshift->monitor->person;
        $monitorshift->task;

        $data = ['data'=>$monitorshift];
        return $this->showOne($data);

    }

    public function store(Request $request)//crea obligatorio el id de la compañea
    {
        $monitorshift = MonitorShift::create($request->all());

        $masterproduction = $monitorshift->shift_has_planning->production_master;
        $masterproduction->dolar_total_assigned += $monitorshift->goal_dollar_monitor;
        $masterproduction->tkn_total_assigned += $monitorshift->goal_tkn_monitor;
        $masterproduction->save();


        $shifthasplanning = ShiftHasPlanning::findOrFail($request->shift_has_planning_id);

            $productiondetailsday = $shifthasplanning->production_master()
                //  ->whereHas('productiondetailsday')
                ->with('productiondetailsdays')
                ->orderBy('id','DESC')
                ->get()
                ->pluck('productiondetailsdays')
                ->collapse()
                ->pluck('id')
                ->unique()
                ->values();

                // dd($productiondetailsday[3]);
            // $longitud = count($productiondetailsday);

            for($i=0; $i <= count($productiondetailsday)-1; $i++){

                $productiondetailsshift = new ProductionDetailsShift();
                $productiondetailsshift->production_details_day_id = $productiondetailsday[$i];
                $productiondetailsshift->shift_id = $request->shift_id;
                $productiondetailsshift->monitorshift_id = $monitorshift->id;
                $productiondetailsshift->save();

            };


        $data = ['data'=>$monitorshift];
        // $data = ['data'=>$productiondetailsday];
        return $this->showOne($data, 201);
    }

    public function destroy(Monitorshift $monitorshift)
    {
        $masterproduction = $monitorshift->shift_has_planning->production_master;
        $masterproduction->dolar_total_assigned = $masterproduction->dolar_total_assigned - $monitorshift->goal_dollar_monitor;
        $masterproduction->tkn_total_assigned = $masterproduction->tkn_total_assigned - $monitorshift->goal_tkn_monitor;
        $masterproduction->save();

        $monitorshift->delete($monitorshift);

        $planningprovider = $monitorshift->planningprovider()
        // ->whereHas('planningprovider')
        // ->with('planningprovider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('planningprovider')
        // ->collapse()
        ->pluck('id')
        ->unique()
        ->values();

        $planningprovider = PlanningProvider::find($planningprovider)->each->delete();

        $productiondetailsshift = ProductionDetailsShift::where('monitorshift_id','=',$monitorshift->id)->delete();

        // $data = ['data'=>$planningprovider];
        $data = ['data'=>$monitorshift, 'data1'=> $planningprovider];
        
        return $this->showOne($data);
    }


}
