<?php

namespace App\Http\Controllers;

use App\Models\ProductionDetailsConnec;
use App\Models\ProductionDetailsShift;
use App\Models\ProductionDetailsDay;
use App\Models\ProductionMaster;
use App\Models\Event;
use App\Models\ShiftHasPlanning;
// App\Http\Controllers\DateTime;s

use Illuminate\Http\Request;
use Carbon\Carbon;


class ProductionDetailsConnecController extends ApiController
{
   
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Room"]
        // ];

        // $productiondetailsconnec= ProductionDetailsConnec::orderBy('id','DESC')->get();

        //  $productiondetailsconnec->each(function($productiondetailsconnec){

        //     foreach ($productiondetailsconnec->accountproductiondetails as $accountproductiondetails) {// m a n
        //             $accountproductiondetails->account;
        //         }
        //     // $productiondetailsconnec->accountproductiondetails;
        //     // $productiondetailsconnec->provider->person;
        //     // $productiondetailsconnec->monitordelivery->person;
        //     // $productiondetailsconnec->monitorreceives->person;

        // });

        // // $productiondetailsconnec->accountproductiondetails;

        // $data = ['data'=>$productiondetailsconnec, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }


    public function store(Request $request)
    {
        $knownDate = Carbon::now();
        $knownDate = new Carbon('next monday');

        //deja este
        $shifthasplanning = ShiftHasPlanning::orderBy('id','DESC')->where('company_id','=',$request->company_id)->where('beginning_week','=',$knownDate->modify('this week -7 days')->format('Y-m-d'))->get()->pluck('id')->toArray();

        //para pruebas
        // $shifthasplanning = ShiftHasPlanning::orderBy('id','DESC')->where('company_id','=',$request->company_id)->where('beginning_week','=',$knownDate->format('Y-m-d'))->get()->pluck('id')->toArray();



        if(empty($shifthasplanning))
        {
            return $this->errorResponse("No Hay Planificación de la Semana en Curso No Puede Guardar Una Conexión",404);
        }

        $id = $shifthasplanning[0];
        
        $array = array( 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');

        $date = Carbon::now();
        $day = $date->format('l');
        $clave = array_search($day, $array);

        $shifthasplanning = ShiftHasPlanning::findOrFail($id);

        $productiondetailsshift = $shifthasplanning->production_master()
        // ->whereHas('productiondetailsdays')
        // ->with('productiondetailsdays.productiondetailsshift.monitor_shift.shift')
        ->with('productiondetailsdays.productiondetailsshift.monitor_shift.monitor.person')
        // // ->with('site')
        // ->with('commission')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('productiondetailsdays')
        ->collapse()
        ->where('day_week','=', $clave)
        ->pluck('productiondetailsshift')
        ->collapse()
        ->where('monitor_shift.monitor_id','=', $request->monitor_id)

        ->pluck('id')

        ->unique()
        ->values();

        $productiondetailsconnec = new ProductionDetailsConnec();
        
        $productiondetailsconnec->connection_start = $request->connection_start;
        $productiondetailsconnec->user_id = $request->user_id;
        $productiondetailsconnec->production_details_shift_id = $productiondetailsshift[0];

        if($request->has('observation_int')){

            $productiondetailsconnec->observation_int = $request->observation_int;
        }

        $productiondetailsconnec->save();

        $shift = $productiondetailsconnec->production_details_shift->monitor_shift->shift;


                if($shift->id == 1){
                                        
                        if($productiondetailsconnec->connection_start > $shift->start ){
                            // dd($timeMentrada);
                            // dd('multa2');
                            $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
                            $event->user_id = $productiondetailsconnec->model_id;
                            $event->processed = 0;
                            // $event->productionmaster_id = $productionmaster->id;
                            $event->productiondetailsconnec_id = $productiondetailsconnec->id;
                            $event->observation = 'Hora de Conexión Sobre Pasa Turno de la Mañana.: '.$productiondetailsconnec->connection_start;
                            $event->event_type_id = 3;
                            $event->save();

                        }
                }else if($shift->id == 2){

                        if($productiondetailsconnec->connection_start > $shift->start ){
                            $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
                            $event->user_id = $productiondetailsconnec->model_id;
                            $event->processed = 0;
                            // $event->productionmaster_id = $productionmaster->id;
                            $event->productiondetailsconnec_id = $productiondetailsconnec->id;
                            $event->observation = 'Hora de Conexión Sobre Pasa Turno de la Tarde.: '.$productiondetailsconnec->connection_start;
                            $event->event_type_id = 3;
                            $event->save();

                        }
                    
                }else if($shift->id == 3){

                        if($productiondetailsconnec->connection_start > $shift->start ){
                            $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
                            $event->processed = 0;
                            $event->user_id = $productiondetailsconnec->model_id;
                            // $event->productionmaster_id = $productionmaster->id;
                            $event->productiondetailsconnec_id = $productiondetailsconnec->id;
                            $event->observation = 'Hora de Conexión Sobre Pasa Turno de la Noche.: '.$productiondetailsconnec->connection_start;
                            $event->event_type_id = 3;
                            $event->save();

                        }

                }



        // return $this->showOne($productiondetailsconnec, 201);
        $data = ['data'=>$productiondetailsconnec];
        return $this->showOne($data);

    }
    
    public function show(ProductionDetailsConnec $productiondetailsconnec)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Room"]
        ];

        $productiondetailsconnec->production_details_shift;


        foreach ($productiondetailsconnec->accountproductiondetails as $accountproductiondetails) {// m a n
            $accountproductiondetails->account;
        }

            $productiondetailsconnec->provider->person;

        $data = ['data'=>$productiondetailsconnec, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }


    public function update(Request $request, ProductionDetailsConnec $productiondetailsconnec)
    {

        if($productiondetailsconnec->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $productiondetailsconnec->fill($request->all())->save();
        $shift = $productiondetailsconnec->production_details_shift->shift;

        if($request->has('connection_end')){
            if($request->connection_end >= $shift->end){

                $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
                $event->user_id = $productiondetailsconnec->model_id;
                $event->processed = 0;
                // $event->productionmaster_id = $productionmaster->id;
                $event->productiondetailsconnec_id = $productiondetailsconnec->id;
                $event->observation = 'Hora de Desconexión es menor a la Permitida.: '.$productiondetailsconnec->connection_end;
                $event->event_type_id = 3;
                $event->save();
            }

        }

        if($request->has('break_end')){
            
            $datework = new Carbon($productiondetailsconnec->break_start);
            $datework1 = new Carbon($request->break_end);
            $diff = $datework->diffInMinutes($datework1);

            $datework->addMinutes($shift->break);

            if($datework <= $datework1){

                $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
                $event->user_id = $productiondetailsconnec->model_id;
                $event->processed = 0;
                // $event->productionmaster_id = $productionmaster->id;
                $event->productiondetailsconnec_id = $productiondetailsconnec->id;
                $event->observation = 'Se Excedio del Break por.: '.$diff.' Minutos';
                $event->event_type_id = 3;
                $event->save();

            }
                
        }

        $productiondetailsconnec->fill($request->all())->save();

        $productiondetailsshift = ProductionDetailsShift::findOrFail($productiondetailsconnec->production_details_shift_id);
        $productiondetailsshift->dolar_total_monitor_shift = $productiondetailsshift->dolar_total_monitor_shift + $productiondetailsconnec->dolar_total_provider;
        $productiondetailsshift->tkn_total_monitor = $productiondetailsshift->tkn_total_monitor + $productiondetailsconnec->tkn_total_provider;
        $productiondetailsshift->save();

        $productiondetailsday = ProductionDetailsDay::findOrFail($productiondetailsshift->production_details_day_id);
        $productiondetailsday->dolar_total_day = $productiondetailsday->dolar_total_day + $productiondetailsshift->dolar_total_monitor_shift;
        $productiondetailsday->tkn_total_day = $productiondetailsday->tkn_total_day + $productiondetailsshift->tkn_total_monitor;
        $productiondetailsday->save();

        $productionmaster = ProductionMaster::findOrFail($productiondetailsshift->production_details_day_id);
        $productionmaster->tkn_total_week = $productionmaster->tkn_total_week + $productiondetailsday->tkn_total_day;
        $productionmaster->dolar_total_week = $productionmaster->dolar_total_week + $productiondetailsday->dolar_total_day;
        $productionmaster->save();


        return $this->showOne($productiondetailsconnec);
        
    }

    public function destroy(ProductionDetailsConnec $productiondetailsconnec)
    {
        // $productiondetailsconnec->delete($productiondetailsconnec);
        // return $this->showOne($productiondetailsconnec);
    }
}
