<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Payroll;
use App\Models\ReceiptPayment;
use Illuminate\Http\Request;
use App\Models\ProductionMaster;
use App\Models\Commission;
use App\Models\PlanningProvider;
use App\Models\MonitorShift;
use App\Models\JobType;
use App\Models\Accounting;
use App\Models\BillToPay;
use App\Models\CompanyType;
use App\Models\BillToCharge;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NotificationUser;//este es el notification de usuario

class EventController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // public function index()
    // {
       
    //     $breadcrumbs = [
    //         ['link'=>"dashboard",'name'=>"Home"], ['name'=>"Lista de Eventos"]
    //     ];
        
    //     $events = Event::all();

    //     $data = ['data'=>$events, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    public function store(Request $request)
    {

        if($request->event_type_id == 2 or $request->event_type_id == 4){

            $event = Event::create($request->all());

            if($request->has('user_id')){

                $id = $request->user_id;

            }elseif($request->has('model_id')){
                $id = $request->model_id;

            }
            
            
        }else if($request->event_type_id == 3){

                $productionmaster = ProductionMaster::findOrFail($request->productionmaster_id);

                $event = new Event();
                $event->processed = 1;

                    if($request->has('productionmaster_id')){

                        $event->productionmaster_id = $productionmaster->id;
                    }    
                
                    $event->observation = $request->observation;
                    $event->value_real = $request->total_cost;
                    $event->event_type_id = 3;
                    $event->save();
            
                    $accounting = new Accounting();
                    $accounting->name = 'Deducion Modelos Por Clases';
                    // $accounting->payroll_id = $payroll->id;
                    $accounting->company_id = $productionmaster->company_id;
                    $accounting->save();
            
                
                    $billtocharge = new BillToCharge();
                    $billtocharge->description = 'Deducion Modelos Por Clases';

                    if($request->has('productionmaster_id')){

                        $billtocharge->total_paid = $request->paid;

                    }   

                    $billtocharge->total_cost = $request->total_cost;
            
                    $billtocharge->accounting_id = $accounting->id;
                    $billtocharge->event_id = $event->id;
            
                    if($request->has('quantity')){
                        $billtocharge->quantity = $request->quantity;
                    }
            
                    $billtocharge->save();


            }

            // $fromUser = $request->create_event_id;

            // $toUser = User::findOrFail($id);
            // $fromUser = User::findOrFail($fromUser);

            // Notification::send($toUser, new NotificationUser($fromUser));

        $data = ['data'=>$event];
        return $this->showAll($data);

    }

    public function show(Event $event)
    {
        // if($event->read_at == null){
        //     $event->read_at = now();
        //     $event->save();
        // }
   
        $event->productiondetailsconnec;
        $event->payroll;
        $event->provider;
        $event->auditshift;
        $event->audits;
        $event->model->person;
        $event->user->person;
        $event->payroll;
        $event->company;

        $data = ['data'=>$event];
        return $this->showOne($data);
    }

    public function showAlert(Event $event)
    {

        if($event->title != null){

            if($event->read_at == null){
                $event->read_at = now();
                $event->save();
            }

            $data = ['data'=>$event];
            return $this->showOne($data);
        }

    }
   
    public function update(Request $request, Event $event)
    {

        if($request->has('observation')){
            $event->observation = $request->observation;
        }

        if($request->has('processed')){
            $event->processed = $request->processed;
        }

        $event->save();

        return $this->showOne($event);
    }

    // public function destroy(Event $event)
    // {
    //     $event->delete($event);
    //     return $this->showOne($event);
    // }

//*******************************************************************************************************************************************************************  */

    public function closePlanning(Request $request, $id)
    {

       $productionmaster = ProductionMaster::findOrFail($id);

        $shifthasplanning = $productionmaster->shift_has_planning;
        $shifthasplanning->status = 'Ejecutada';
        $shifthasplanning->save();

        $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
        $event->processed = 1;
        $event->productionmaster_id = $productionmaster->id;
        $event->observation = 'Ejecutada la planificación';
        $event->event_type_id = 5;
        $event->save();

        $productiondetailsconnecs = $productionmaster->productiondetailsdays()
    //    ->whereHas('productiondetailsdays')
       ->with('productiondetailsshift.productiondetailsconnec')
    //    ->with('provider.productiondetailsconnec')
       ->orderBy('id','DESC')
       ->get()
       ->pluck('productiondetailsshift')
       ->collapse()
       ->pluck('productiondetailsconnec')
       ->collapse()
    //    ->groupBy('model_id')
       ->unique()
       ->values();

       $monitorshifts = $productionmaster->shift_has_planning->monitorshift;//->planningprovider->model;

        foreach($monitorshifts as $monitorshift){
                foreach($monitorshift->planningprovider as $planningprovider){
                    foreach($productiondetailsconnecs as $productiondetailsconnec){
                            if($planningprovider->model->id = $productiondetailsconnec->model_id){
                                $planningprovider->production_total_dollar += $productiondetailsconnec->dolar_total_provider;
                                $planningprovider->production_total_tkn += $productiondetailsconnec->tkn_total_provider;

                            }

                        }

                    $planningprovider->save();

                }
        }

        $data = ['data'=>$planningprovider];
        return $this->showOne($data, 201);

    }


    // public function payCommission(Request $request, $id)
    // public function commissionCalculation90(Request $request, $id)
	protected function commissionCalculation90($id)
    {
        //90% de las modelos lleguen a la meta (metodo por monitor shift y planning provider para revisar las modelos pasen el 90 en la suma de las conection)
        //10% de el aumento de la modelo con respecto a la semana anterior (construir el comparador de la semana anterio mas un 10% estimada para la siguiente por modelo)
        //1.5% si cumple cualquiera de las anteriores si cumple las 2 el 2%

        $productionmaster = ProductionMaster::findOrFail($id);

        $monitorshifts = $productionmaster->shift_has_planning()
    //    ->whereHas('productiondetailsdays')
       ->with('monitorshift.planningprovider')
       ->orderBy('id','DESC')
       ->get()
       ->pluck('monitorshift')
       ->collapse()
       ->unique()
       ->values();

        $mayor = 0;
        $menoralameta = 0;
        $totalmodelos = 0;

        foreach($monitorshifts as $monitorshift){
            $totalmodelos = $monitorshift->planningprovider->count() * 0.9;

                foreach($monitorshift->planningprovider as $planningprovider){
                    // dd($monitorshift->planningprovider->count());
                    // dd($planningprovider->count());
                    // foreach($productiondetailsconnecs as $productiondetailsconnec){
                                            if($planningprovider->production_total_dollar >= $planningprovider->goal_dollar){
                                                $mayor += 1;
                                            }else {
                                                $menoralameta += 1;
                                            //     // no se paga la comision
                                            }

                        }
                    // dd($totalmodelos . $mayor .$menoralameta );
//                              2.7       1            2
                if($totalmodelos >= $mayor){
                    $monitorshift->commission_payment90 = 1;
                    $monitorshift->save();
                } else {
                    // dd('aqui');
                    $monitorshift->commission_payment90 = 0;
                    $monitorshift->save();
                }

                    $mayor = 0;
        }

        $data = ['data'=>$monitorshifts];
        return $this->showOne($data, 201);

    }

	protected function commissionCalculation10($id)
    // public function commissionCalculation10(Request $request, $id)
    {
        //90% de las modelos lleguen a la meta (metodo por monitor shift y planning provider para revisar las modelos pasen el 90 en la suma de las conection)
        //10% de el aumento de la modelo con respecto a la semana anterior (construir el comparador de la semana anterio mas un 10% estimada para la siguiente por modelo)
        //1.5% si cumple cualquiera de las anteriores si cumple las 2 el 2%

        $productionmaster = ProductionMaster::findOrFail($id);

        $productionmasterprevious = ProductionMaster::find($id-1);
        $productionmasterprevious2 = ProductionMaster::find($id-2);

            if (!empty($productionmasterprevious)) {


                $monitorshifts = $productionmaster->shift_has_planning()
                //    ->whereHas('productiondetailsdays')
                   ->with('monitorshift.planningprovider')
                   ->orderBy('id','DESC')
                   ->get()
                   ->pluck('monitorshift')
                   ->collapse()
                   ->unique()
                   ->values();

                    $monitorshiftsprevious = $productionmasterprevious->shift_has_planning()
                    //    ->whereHas('productiondetailsdays')
                        ->with('monitorshift.planningprovider')
                        ->orderBy('id','DESC')
                        ->get()
                        ->pluck('monitorshift')
                        ->collapse()
                        ->unique()
                        ->values();
                        
                        // $mayor = 0;
                        // // $menoralameta = 0;
                        // $totalmodelos = 0;

                        // $data = ['data'=>$monitorshifts, 'data1'=>$monitorshiftsprevious];
                        // return $this->showOne($data, 201);

                        foreach($monitorshifts as $monitorshift){
                            foreach($monitorshiftsprevious as $monitorshiftspreviou){

                                    $monitorshift->planningprovider->sum('production_total_dollar');
                                        //33888.0
                                    if( $monitorshift->monitor_id ==  $monitorshiftspreviou->monitor_id){
                                        // dd( $monitorshiftspreviou->planningprovider->sum('production_total_dollar'));

                                            if( ($monitorshift->planningprovider->sum('production_total_dollar') /  $monitorshiftspreviou->planningprovider->sum('production_total_dollar')) >= 1.10){
                                                            $monitorshift->commission_payment10 = 1;
                                                            $monitorshift->save();
                                            }else {

                                                    $monitorshift->commission_payment10 = 0;
                                                    $monitorshift->save();
                                                }

                            }

                    }

                    }
        } else {

                $monitorshift->commission_payment10 = 1;
                $monitorshift->save();

        }

        $data = ['data'=>$monitorshifts, 'data1'=>$monitorshiftsprevious];
        return $this->showOne($data, 201);

    }



    public function commission15(Request $request, $id)
	{
		$this->commissionCalculation90($id);
        $this->commissionCalculation10($id);
        
        $productionmaster = ProductionMaster::findOrFail($id);
        $commission = Commission::first();

        $monitorshifts = $productionmaster->shift_has_planning()
        //    ->whereHas('productiondetailsdays')
           ->with('monitorshift.planningprovider')
           ->orderBy('id','DESC')
           ->get()
           ->pluck('monitorshift')
           ->collapse()
           ->unique()
           ->values();


           $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
           $event->processed = 1;
           $event->productionmaster_id = $productionmaster->id;
           $event->observation = 'calculo de comisiones de monitor';
           $event->event_type_id = 6;
           $event->save();

           $jobtype = JobType::findOrFail(1);
           

           foreach($monitorshifts as $monitorshift){

                if($monitorshift->commission_payment90 == 1 and $monitorshift->commission_payment90 == 1){

                            // se paga el 1.5
                        $receiptpayment = new ReceiptPayment();
                        $receiptpayment->event_id = $event->id;
                        $receiptpayment->pay_salary = $jobtype->salary / 4;//definir si las comisiones deben ser quinsenal
                        $receiptpayment->user_id = $monitorshift->user_id;
                        $receiptpayment->paycommission = $monitorshift->planningprovider->sum('production_total_dollar') * $commission->percentage3;
                        $receiptpayment->production = $monitorshift->planningprovider->sum('production_total_dollar');
                        $receiptpayment->commission = $commission->percentage3;
                        $receiptpayment->save();

                }else if($monitorshift->commission_payment90 == 1 or $monitorshift->commission_payment90 == 1){
                        // se paga el 1

                        $receiptpayment = new ReceiptPayment();
                        $receiptpayment->event_id = $event->id;
                        $receiptpayment->pay_salary = $jobtype->salary / 4;//definir si las comisiones deben ser quinsenal
                        $receiptpayment->user_id = $monitorshift->user_id;
                        $receiptpayment->paycommission = $monitorshift->planningprovider->sum('production_total_dollar') * $commission->percentage2;
                        $receiptpayment->production = $monitorshift->planningprovider->sum('production_total_dollar');
                        $receiptpayment->commission = $commission->percentage2;
                        $receiptpayment->save();
                       
                }else {
                    // se paga la 

                    $receiptpayment = new ReceiptPayment();
                    $receiptpayment->event_id = $event->id;
                    $receiptpayment->pay_salary = $jobtype->salary / 4;//definir si las comisiones deben ser quinsenal
                    $receiptpayment->user_id = $monitorshift->user_id;
                    $receiptpayment->paycommission = $monitorshift->planningprovider->sum('production_total_dollar');
                    $receiptpayment->production = $monitorshift->planningprovider->sum('production_total_dollar');
                    $receiptpayment->commission = 0;
                    $receiptpayment->save();

                }
                

           }

        $data = ['data'=>$monitorshifts];
        return $this->showOne($data, 201);
        
		
	}


    public function payroll(Request $request, $id)
    {
        $productionmaster = ProductionMaster::findOrFail($id);

        $event = new Event();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
        $event->processed = 1;
        $event->productionmaster_id = $productionmaster->id;
        $event->observation = 'cerrando nomina';
        $event->event_type_id = 7;
        $event->save();

        $payroll = new Payroll();// entre produccion se debe hacer una tabla muchos a muchos para el calculo de nomina quicenal estaria asociada a 2 producciones maestra de semana
        $payroll->beginning = $request->beginning;
        $payroll->end = $request->end;
        $payroll->save();
       
        $receiptpayments = $productionmaster->events()
        //    ->whereHas('productiondetailsdays')
           ->with('receiptpayment')
           ->orderBy('id','DESC')
           ->get()
        //    ->pluck('monitorshift')
        //    ->collapse()
           ->unique()
           ->values();

           $total = 0;

           foreach($receiptpayments as $receiptpayment){
                    $receiptpayment->payroll_id = $payroll->id;
                    $total = $receiptpayment->paycommission;
                    $receiptpayment->save();
            }

            $payroll->total = $total;
            $payroll->save();

            $accounting = new Accounting();
            $accounting->name = 'nomina';
            $accounting->payroll_id = $payroll->id;
            $accounting->company_id = $productionmaster->company_id;
            $accounting->save();

            $data = ['data'=>$payroll, 'data1'=>$accounting];
            return $this->showOne($data, 201);
    }


    public function awards(Request $request, $id)//importante user_id
    {
        // dd($request->observation);
        $productionmaster = ProductionMaster::findOrFail($id);

        $event = new Event();
        $event->processed = 1;
        $event->productionmaster_id = $productionmaster->id;
        $event->observation = $request->observation;
        $event->value_real = $request->total_cost;
        $event->event_type_id = 2;
        $event->save();

        $accounting = new Accounting();
        $accounting->name = 'Premio';
        // $accounting->payroll_id = $payroll->id;
        $accounting->company_id = $productionmaster->company_id;
        $accounting->save();

        $billtopay = new BillToPay();
        $billtopay->description = $request->description;
        $billtopay->way_to_pay = $request->way_to_pay;
        // $billtopay->transfer_code = $request->transfer_code;
        // $billtopay->quantity = $request->quantity;
        $billtopay->total_cost = $request->total_cost;
        $billtopay->total_paid = $request->paid;
        $billtopay->accounting_id = $accounting->id;
        $billtopay->event_id = $event->id;
        $billtopay->save();

        if($request->has('transfer_code')){
            $billtopay->transfer_code = $request->transfer_code;
        }

        if($request->has('quantity')){
            $billtopay->quantity = $request->quantity;
        }
        
        if($request->has('paid')){
            // dd('aqui');
            $billtopay->users()->attach($request->user_id, ['paid' => $request->paid]);

            // $billtopay->quantity = $request->quantity;
        }
        $billtopay->save();

        $billtocharge = new BillToCharge();
        $billtocharge->description = $request->description;
        $billtocharge->total_paid = $request->paid;
        $billtocharge->total_cost = $request->total_cost;

        $billtocharge->accounting_id = $accounting->id;
        $billtocharge->event_id = $event->id;
        $billtocharge->bill_to_pay_id = $billtopay->id;

        if($request->has('quantity')){
            $billtocharge->quantity = $request->quantity;
        }

        $billtocharge->save();


 
            $data = ['data'=>$billtopay, 'data1'=>$event];
            return $this->showOne($data, 201);
    }


    public function earningsStudies(Request $request, $id)//CUENTA DE COBRO
    {
        // dd($request->total_paid);
        $productionmaster = ProductionMaster::findOrFail($id);

        $event = new Event();
        $event->processed = 1;
        $event->productionmaster_id = $productionmaster->id;
        $event->observation = $request->observation;
        // $event->value_real = $request->total_cost;
        $event->event_type_id = 9;
        $event->save();

        $accounting = new Accounting();
        $accounting->name = 'Pago Estudios y Sub-Estudios';
        // $accounting->payroll_id = $payroll->id;
        $accounting->company_id = $productionmaster->company_id;
        $accounting->save();

        $productionmaster->company->companytype;

        $earning = $productionmaster->company->companytype->commission *  $productionmaster->dolar_total_week;
        // dd($productionmaster->company->companytype->commission);

        $billtopay = new BillToPay();
        $billtopay->description = $request->description;
        $billtopay->way_to_pay = $request->way_to_pay;
        // $billtopay->transfer_code = $request->transfer_code;
        // $billtopay->quantity = $request->quantity;
        $billtopay->total_cost = $request->total_cost;
        $billtopay->total_paid = $request->paid;
        $billtopay->accounting_id = $accounting->id;
        $billtopay->event_id = $event->id;
        $billtopay->save();

        if($request->has('transfer_code')){
            $billtopay->transfer_code = $request->transfer_code;
        }

        if($request->has('quantity')){
            $billtopay->quantity = $request->quantity;
        }
        
        if($request->has('paid')){//debe a ver un enlace con compañea y cuentas por pagar
            // dd('aqui');
            // $billtopay->users()->attach($request->user_id, ['paid' => $request->paid]);
            $billtopay->study()->attach($request->company_id, ['paid' => $request->paid]);//ese company Id es el de du

            // $billtopay->quantity = $request->quantity;
        }

        $billtopay->save();

        $billtocharge = new BillToCharge();
        $billtocharge->description = $request->description;
        $billtocharge->total_paid = $request->paid;
        $billtocharge->total_cost = $request->total_cost;

        $billtocharge->accounting_id = $accounting->id;
        $billtocharge->event_id = $event->id;
        $billtocharge->bill_to_pay_id = $billtopay->id;

        if($request->has('quantity')){
            $billtocharge->quantity = $request->quantity;
        }

        $billtocharge->save();

        // $data = ['data'=>$productionmaster, 'data1'=>$earning,'data2'=>$billtopay];
        // return $this->showOne($data, 201);

            $data = ['data'=>$billtopay, 'data1'=>$billtocharge];
            return $this->showOne($data, 201);
    }


    public function earningsModels(Request $request, $id)//CUENTA DE COBRO
    {
        // dd($request->total_paid);
        $productionmaster = ProductionMaster::findOrFail($id);

        $event = new Event();
        $event->processed = 1;
        $event->productionmaster_id = $productionmaster->id;
        $event->observation = $request->observation;
        $event->event_type_id = 10;
        $event->save();

        $accounting = new Accounting();
        $accounting->name = 'Pago Modelos';
        // $accounting->payroll_id = $payroll->id;
        $accounting->company_id = $productionmaster->company_id;
        $accounting->save();

        
        $modelossatelite = $productionmaster->productiondetailsdays()
        ->whereHas('productiondetailsshift.productiondetailsconnec')
        // ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.accountproductiondetails.account')
        ->with('productiondetailsshift.productiondetailsconnec')

        ->orderBy('id','DESC')
        ->get()
        ->pluck('productiondetailsshift')
        ->collapse()
        ->pluck('productiondetailsconnec')
        ->collapse()
        ->pluck('user_id')

        ->unique()
        ->values()
        ->toArray();

        $users = $productionmaster->company()
        ->whereHas('user.person.provider.jobtype')
        ->with('user.person.provider.jobtype')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('user')
        ->collapse()
        ->whereIn('id',$modelossatelite) //TODO: sirve en uno solo
        ->unique()
        ->values();


        $productions = $productionmaster->productiondetailsdays()
        ->whereHas('productiondetailsshift.productiondetailsconnec')
        // ->with('productiondetailsdays.productiondetailsshift.productiondetailsconnec.accountproductiondetails.account')
        ->with('productiondetailsshift.productiondetailsconnec')

        ->orderBy('id','DESC')
        ->get()
        // ->where('id','=', $request->productionmaster_id)
        // ->pluck('productiondetailsdays')
        // ->collapse()
        ->pluck('productiondetailsshift')
        ->collapse()
        ->pluck('productiondetailsconnec')
        ->collapse()
        // ->pluck('user_id')

        // ->groupBy('user_id')

        // ->whereIn('jobtype_id',[3,4]) TODO: sirve en uno solo
        // ->where('jobtype_id','=','4')
        //  ->whereBetween('created_at', array($request->fechain,$request->fechater))

        //  ->groupBy('provider_id');

        ->unique()
        ->values();

        $earning = 0;
        // foreach($commission->person->provider->jobtype as $jobtype){
            foreach($users as $user){
// dd($user->person->provider->jobtype);
             foreach($productions as $production){

                    if($production->user_id == $user->id){

                       $earning += $production->dolar_total_provider * $user->person->provider->jobtype->value;

                                $billtopay = new BillToPay();
                                $billtopay->description = 'calculo de la produccion'.$productionmaster->id;
                                // $billtopay->way_to_pay = $request->way_to_pay;
                                // $billtopay->transfer_code = $request->transfer_code;
                                // $billtopay->quantity = $request->quantity;
                                $billtopay->total_cost = $earning;
                                $billtopay->production_system = 1;
                                $billtopay->accounting_id = $accounting->id;
                                $billtopay->event_id = $event->id;
                                $billtopay->user_id = $user->id;
                                $billtopay->save();

                                if($request->has('transfer_code')){
                                    $billtopay->transfer_code = $request->transfer_code;
                                }

                                if($request->has('quantity')){
                                    $billtopay->quantity = $request->quantity;
                                }
                                
                                if($request->has('paid')){//debe a ver un enlace con compañea y cuentas por pagar
                                    // dd('aqui');
                                    $billtopay->users()->attach($production->user_id, ['paid' => $request->paid]);
                                    // $billtopay->study()->attach($request->company_id, ['paid' => $request->paid]);//ese company Id es el de du

                                    // $billtopay->quantity = $request->quantity;
                                }

                                $billtopay->save();

                                        $billtocharge = new BillToCharge();
                                        $billtocharge->description = 'cuenta de cobro de modelo'.$productionmaster->id;
                                        $billtocharge->production_system = 1;
                                        $billtocharge->total_cost = $earning;

                                        $billtocharge->accounting_id = $accounting->id;
                                        $billtocharge->event_id = $event->id;
                                        $billtocharge->bill_to_pay_id = $billtopay->id;

                                        if($request->has('quantity')){
                                            $billtocharge->quantity = $request->quantity;
                                        }

                                        $billtocharge->save();

                    }

             }
        }

        

        $data = ['data'=>$modelossatelite, 'data1'=>$users , 'data2'=>$productions];
        return $this->showOne($data, 201);

    }

 

    
}
