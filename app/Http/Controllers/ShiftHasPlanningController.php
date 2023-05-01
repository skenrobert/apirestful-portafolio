<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShiftHasPlanning;
use App\Models\ProductionMaster;
use App\Models\ProductionDetailsDay;
// use App\Models\ProductionDetailsShift;
use App\Models\MonitorShift;
use App\Models\PlaninngProvider;
use App\Models\Shift;
use App\Models\ProductionDetailsConnec;
use App\Models\PlanningProvider;
use App\Models\Commission;
use App\Models\ProductionDetailsShift;


use Carbon\Carbon;


// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Redirect;
// use App\Notifications\NotificationUser;//este es el notification de usuario
// use Illuminate\Notifications\Notifiable;



// //para shinobi
// use Illuminate\Support\Facades\Validator;
// use Caffeinated\Shinobi\Models\Role;
// use Caffeinated\Shinobi\Models\Permission;




class ShiftHasPlanningController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
   
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores"]
        // ];
     
        // $shifthasplannings= ShiftHasPlanning::orderBy('id','DESC')->get();

        // $shifthasplannings->each(function($shifthasplannings){
        //     $shifthasplannings->monitorshift;
        //     $shifthasplannings->planningprovider;

        //   });
        
        // $data = ['data'=>$shifthasplannings, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)//crea obligatorio el id de la compañea
    {
        // dd($request);
        $shifts = Shift::orderBy('id', 'ASC')->get();
        $commission = Commission::firstOrFail();

        $knownDate = Carbon::now();
        $knownDate = new Carbon('next monday');

        $shifthasplanning = ShiftHasPlanning::orderBy('id','DESC')->where('company_id','=',$request->company_id)->where('beginning_week','=',$knownDate->format('Y-m-d'))->pluck('beginning_week')->toArray();
        
        if(!empty($shifthasplanning))//TODO revisar consulta porque se realiza en la tabla locker
        {
            return $this->errorResponse("Ya Existe una planificacion con en las semana siguiente editela",404);
        }
      
        $shifthasplanning = ShiftHasPlanning::create($request->all());
        $shifthasplanning->company_id = $request->company_id;
        $shifthasplanning->status = 'Planeacion';
        $shifthasplanning->beginning_week = $knownDate->format('Y-m-d');  
        $shifthasplanning->end_week = $knownDate->endOfWeek()->format('Y-m-d');  
        $shifthasplanning->save();

        // dd($shifthasplanning->id);

        $productionmaster = new ProductionMaster();
        $productionmaster->company_id = $request->company_id;//$company->id;
        $productionmaster->shift_has_planning_id = $shifthasplanning->id;
        $productionmaster->commission_id = $commission->id;//$company->id;
        $productionmaster->save();

        for($i=1; $i <= 7; $i++){

            $productiondetailsday = new ProductionDetailsDay();
            $productiondetailsday->production_master_id = $productionmaster->id;
            $productiondetailsday->day_week = $i;
            $productiondetailsday->save();

            //TODO: esta en Monitor shift
                // foreach ($shifts as $shift) {// m a n
                //     $productiondetailsshift = new ProductionDetailsShift();
                //     $productiondetailsshift->production_details_day_id = $productiondetailsday->id;
                //     $productiondetailsshift->shift_id = $shift->id;
                //     $productiondetailsshift->save();
                    
                // }

        };



    //     return $this->showOne($productionmaster, 201);

        // $data = ['data'=>$a];
        $data = ['data'=>$shifthasplanning];
        return $this->showOne($data, 201);
    }

    public function show(ShiftHasPlanning $shifthasplanning)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Planificacion"]
        ];

        $shifthasplanning->production_master;

        foreach($shifthasplanning->monitorshift as $monitorshift){

            $monitorshift->shift;
            $monitorshift->monitor->person;
            $monitorshift->task;

            foreach($monitorshift->planningprovider as $planningprovider){
                $planningprovider->modelo;
                $planningprovider->room;
            }
        }

       

       

        $data = ['data'=>$shifthasplanning, 'breadcrumbs'=> $breadcrumbs];

        return $this->showOne($data);
        
    }

    public function update(Request $request, ShiftHasPlanning $shifthasplanning)
    {

        if($shifthasplanning->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        // $shifthasplanning->fill($request->all())->save();
        if($request->has('observation')){
            $shifthasplanning->observation = $request->observation;
        }
        if($request->has('goal_week')){
            $shifthasplanning->goal_week = $request->goal_week;
        }
        if($request->has('status')){
            $shifthasplanning->status = $request->status;
        }
        if($request->has('confirmed')){
            $shifthasplanning->confirmed = $request->confirmed;
        }
        $shifthasplanning->save();

        return $this->showOne($shifthasplanning);
    }

    public function destroy(ShiftHasPlanning $shifthasplanning)
    {
        // $shifthasplanning->delete($shifthasplanning);
        // return $this->showOne($shifthasplanning);
    }


    public function cloneShifthasplanning(ShiftHasPlanning $shifthasplanning)
    {

        $new_shifthasplanning = $shifthasplanning->replicate();

        $knownDate_beg = new Carbon($new_shifthasplanning->beginning_week); 
        $knownDate_end = new Carbon($new_shifthasplanning->end_week); 
        $knownDate_beg->addDays(7);
        $knownDate_end->addDays(7);

        $new_shifthasplanning->status = 'Planeacion';
        $new_shifthasplanning->observation = '';
        $new_shifthasplanning->beginning_week = $knownDate_beg;
        $new_shifthasplanning->end_week = $knownDate_end;
        $new_shifthasplanning->save();
        
            $productionmaster = $shifthasplanning->production_master;
            $new_productionmaster = $productionmaster->replicate();
            $new_productionmaster->shift_has_planning_id = $new_shifthasplanning->id;
            $new_productionmaster->tkn_total_week = null;
            $new_productionmaster->dolar_total_week = null;
            $new_productionmaster->total_cop = null;
            $new_productionmaster->observation_week = null;
            $new_productionmaster->closed = 1;
            $new_productionmaster->commission_employed_payment = 0;
            // $new_productionmaster->estimated = 0;
            $new_productionmaster->save();

            $monitorshift = $shifthasplanning->monitorshift;

            foreach($shifthasplanning->monitorshift as $monitorshift){

                $new_monitorshift = $monitorshift->replicate();
                $new_monitorshift->shift_has_planning_id = $new_shifthasplanning->id;
                $new_monitorshift->observation = '';
                // $new_monitorshift->goal_dollar_monitor = null;
                // $new_monitorshift->goal_tkn_monitor = null;
                // $new_monitorshift->dolar_assigned = null;
                // $new_monitorshift->tkn_assigned = null;
                $new_monitorshift->commission_payment90 = null;
                $new_monitorshift->commission_payment10 = null;
                $new_monitorshift->push();
                
                foreach($monitorshift->planningprovider as $planningprovider){
                            
                            $new_planningprovider = $planningprovider->replicate();
                            $new_planningprovider->monitor_shift_id = $new_monitorshift->id;
                            $new_planningprovider->observation = '';
                            $new_planningprovider->used = 0;
                            // $new_planningprovider->goal_dollar = null;
                            // $new_planningprovider->goal_tkn = null;
                            $new_planningprovider->production_total_dollar = null;
                            $new_planningprovider->production_total_tkn = null;
                            $new_planningprovider->production_total_tkn = 0;
                            $new_planningprovider->push();

                        }

            }

            $data = ['data'=>$shifthasplanning, 'data1'=>$new_shifthasplanning];

            return $this->showOne($data);
        
    }
    
}
