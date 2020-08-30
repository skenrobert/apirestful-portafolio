<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends ApiController
{
    public function index()
    {
       //listar por el imventario
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Articulos"]
        // ];

        // $Payrolls= Payroll::orderBy('id','DESC')->get();

        // $data = ['data'=>$Payrolls, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $Payroll = Payroll::create($request->all());

        // if($request->has('company_id')){
        //     $Payroll->company_id = $request->company_id;
        // }
        
        // $Payroll->save();
        // $Payroll->taxes()->syncwithoutdetaching($request->tax_id);
        // $Payroll->taxes;

        return $this->showOne($Payroll, 201);

    }

    public function show(Payroll $Payroll)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Nomina"]
        ];
        
        // $Payroll->taxes;

        $data = ['data'=>$Payroll, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Payroll $Payroll)
    {

        if($Payroll->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $Payroll->fill($request->all())->save();

        // $Payroll->taxes()->syncwithoutdetaching($request->tax_id);

        return $this->showOne($Payroll);
    }

    public function destroy(Payroll $Payroll)
    {
        // $Payroll->delete($Payroll);
        // return $this->showOne($Payroll);


        // if(!$company->Payroll()->find($request->tax_id))
        // {
        //     return $this->errorResponse("El Articulo especificado no esta Asociado a esa empresa",404);
        // }

        // $Payroll->taxes()->detach($request->tax_id);
        // $Payroll->taxes;
        // return $this->showAll($Payroll);
    }

    public function payroll(Request $request, $id)
    {
        
        $productionmaster = ProductionMaster::findOrFail($id);
        $productionmaster->closed = 1;//cierra la planificacion tambien
        $productionmaster->save();

        $event = new Event();
        $event->processed = 1;
        // $event->productionmaster_id = $productionmaster->id;
        $event->observation = 'calculo de nomina';
        $event->event_type_id = 6;// debe ser 5
        $event->save();

        //genero un evento ahora o genero la nomina
        
        // $payroll = new Payroll();// la nomina debe ser calculada 2 veces al mes
        // $payroll->status = 'Ejecutada';
        // $payroll->save();

        $commission = Commission::firstOrFail();
        // if($request->has('commission_id')){
            // $event = Event::create($request->all());
            // $event->commission_id = $commission->commission_id;
            // $event->save();
        // }

        //debo crear una nomina y luego con esos 2 id crear el recibo de pago

        $payroll = new Payroll();
        // $productionmaster->company_id = $request->company_id;//$company->id;
        // $productionmaster->shift_has_planning_id = $shifthasplanning->id;
        // $productionmaster->commission_id = $commission->id;//$company->id;
        // $productionmaster->save();

        $receiptpayment = new ReceiptPayment();

        foreach($monitorshift->planningprovider as $planningprovider){

            if($planningprovider->goal_dollar == $planningprovider->production_total_dollar){
                dd($planningprovider);
                dd('meta es igual');


            }else if($planningprovider->goal_dollar >= $planningprovider->production_total_dollar){

                dd('meta es mayor');

                $payroll = new Payroll();


            }else if($planningprovider->goal_dollar <= $planningprovider->production_total_dollar){
                dd($planningprovider);

                dd('meta es menor');

                $payroll = new Payroll();


            }


        }

    }
}
