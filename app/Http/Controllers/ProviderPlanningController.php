<?php

namespace App\Http\Controllers;

use App\Models\PlanningProvider;
use App\Models\User;
use App\Models\ProductionMaster;
use Illuminate\Http\Request;
use App\Http\Requests\ProviderPlanningRequest;


class ProviderPlanningController extends ApiController
{


    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');
        // $this->middleware('permission:roles.edit');
        $this->middleware('auth');
        $this->middleware('roleshinobi:monitor');

    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Modelos por Turno"]
        // ];
     
        // // $companies = Company::has('companytype')->get();
        // $providerplanning= PlanningProvider::orderBy('id','DESC')->get();

        // $providerplanning->each(function($providerplanning){
        //     $providerplanning->room;
        //     $providerplanning->provider;

        //   });

        // $data = ['data'=>$providerplanning, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function show(PlanningProvider $providerplanning)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Detalles de Horario de Modelo"]
        ];
     
            $providerplanning->room;
            // $providerplanning->model;
            $providerplanning->model->person;
            $providerplanning->shift;
            // $providerplanning->monitor;
            // $providerplanning->shift_has_planning;

        $data = ['data'=>$providerplanning, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function store(ProviderPlanningRequest $request)//crea obligatorio el id de la compañea
    {
        $providerplanning = PlanningProvider::create($request->all());
        $providerplanning->used = 1;
        $providerplanning->room->status = 1;
        $providerplanning->save();
        $monitorshift = $providerplanning->monitor_shift;
        $productionmaster =  $providerplanning->monitor_shift->shift_has_planning->production_master;

        if($request->has('goal_dollar')){

            $monitorshift->dolar_assigned += $providerplanning->goal_dollar;
            $monitorshift->tkn_assigned += $providerplanning->goal_tkn;
            $monitorshift->save();
            $productionmaster->dolar_total_assigned += $providerplanning->goal_dollar;
            $productionmaster->tkn_total_assigned += $providerplanning->goal_tkn;
            $productionmaster->save();

            
        }else{

            $monitorshift->dolar_assigned += $monitorshift->shift_has_planning->production_master->dolar_week_default;
            $monitorshift->tkn_assigned += $monitorshift->shift_has_planning->production_master->tkn_week_default;
            $monitorshift->save();
            $productionmaster->dolar_total_assigned += $monitorshift->shift_has_planning->production_master->dolar_week_default;
            $productionmaster->tkn_total_assigned += $monitorshift->shift_has_planning->production_master->tkn_week_default;
            $productionmaster->save();

        }

        $data = ['data'=>$providerplanning];
        return $this->showOne($data, 201);
    }

    public function update(Request $request, PlanningProvider $providerplanning)
    {
        if($providerplanning->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }
        

        if($request->has('observation')){
            $providerplanning->observation = $request->observation;
        }

        if($request->has('model_id')){
            $providerplanning->model_id = $request->model_id;
        }

        if($request->has('goal_dollar')){

            $providerplanning->goal_dollar = $request->goal_dollar;
            $providerplanning->goal_tkn = $request->goal_tkn;
            $providerplanning->save();

            $monitorshift = $providerplanning->monitor_shift;

            $sum = 0;
            $sum2 = 0;
            foreach ($monitorshift->planningprovider as $planningprovider) {//TODO esta malo deberia recorrer las planificaciones del monitor shift no todas sola 1
                $sum += $planningprovider->goal_dollar;
                $sum2 += $planningprovider->goal_tkn;
            }

            $productionmaster =  $providerplanning->monitor_shift->shift_has_planning->production_master;

            $productionmaster->dolar_total_assigned = $productionmaster->dolar_total_assigned - $monitorshift->dolar_assigned;
            $productionmaster->tkn_total_assigned = $productionmaster->tkn_total_assigned - $monitorshift->tkn_assigned;

            $monitorshift->dolar_assigned = $sum;
            $monitorshift->tkn_assigned = $sum2;
            $monitorshift->save();

            $productionmaster->dolar_total_assigned += $sum;
            $productionmaster->tkn_total_assigned += $sum2;
            $productionmaster->save();

            // foreach ($shifthasplanning->monitorshift as $monitorshift) {
            //     $sum3 += $monitorshift->dolar_assigned;
            //     $sum4 += $monitorshift->tkn_assigned;
            // }

            // // $sum3 = $shifthasplanning->monitorshift->sum('goal_dollar_monitor');
            // // $sum4 = $shifthasplanning->monitorshift->sum('goal_tkn_monitor');

            // $masterproduction = $shifthasplanning->masterproduction;
            // // $masterproduction->dolar_total_assigned += $masterproduction->dolar_total_assigned + $sum;
            // $masterproduction->tkn_total_assigned = $masterproduction->tkn_total_assigned + $sum2;
            // $masterproduction->save();


        }
        //$providerplanning->monitor_shift_id = $request->monitor_shift_id;

        if($request->room_id == null){
             $providerplanning->room_id = null;
             //$providerplanning->room->status = 0;
            $providerplanning->used = 0;

        }else{
            $providerplanning->room_id = $request->room_id;
            //$providerplanning->room->status = 1;
            $providerplanning->used = 1;
        }

        $providerplanning->save();
        $providerplanning->room;
        $providerplanning->model->person;
        $providerplanning->monitor_shift->shift_has_planning->production_master;

        $data = ['data'=>$providerplanning];
        // $data = ['data'=>$shifthasplanning, 'data1'=>$providerplanning];
        return $this->showOne($data);

    }

    public function destroy(PlanningProvider $providerplanning)
    {
        $providerplanning->delete($providerplanning);
        return $this->showOne($providerplanning);
    }

    public function listenBroadcast()
    {
        return view('/pages/listenBroadcast');
    }


}
