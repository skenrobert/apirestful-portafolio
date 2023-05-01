<?php

namespace App\Http\Controllers;

use App\Models\AccountReceiptModel;
use App\Models\BulkLoad;
use App\Models\Site;
use App\Models\ProductionMaster;
use App\Models\Person;
use App\Models\Event;
use App\Models\Accounting;
use App\Models\Company;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class AccountReceiptModelController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de AccountReceiptModel"]
        ];

            $accountreceiptmodels= AccountReceiptModel::orderBy('id','DESC')->get();
          
        $data = ['data'=>$accountreceiptmodels, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }

    // public function show(Request $request) 

    public function store(Request $request) 
    {
        $productionmasters = ProductionMaster::all();

        $productionmaster = $productionmasters->last();

        $sites = Site::orderBy('id','DESC')->get();

        $bulkload = BulkLoad::orderBy('id','ASC')
        ->whereNull('document_number')
        // ->with('Provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values()
        ->each->delete();
        
        $bulkloads = BulkLoad::orderBy('id','DESC')->get();

        $sites = Site::orderBy('id','ASC')->get();

        $accountreceiptmodelAll = [];

        $accounting = new Accounting();
        $accounting->name = 'Pago Modelos';
        // $accounting->payroll_id = $payroll->id;
        $accounting->company_id = 1;//asumo que golden es la compañea 1 (sino se debe sacar el user_id)
        $accounting->save();

        foreach ($bulkloads as $bulkload) {

            if ($bulkload->token_mfc != null or $bulkload->token_chat != null or $bulkload->token_stripchat != null or $bulkload->token_camsoda != null or $bulkload->token_bongas != null or $bulkload->token_cam4 != null or $bulkload->token_jasmin != null or $bulkload->token_streamate != null ) {

                        $accountreceiptmodel = new AccountReceiptModel();

                        // if ($bulkload->document_number != null) {//TEST descomenta si no es prueba

                        //     $trozos = explode("-", $bulkload->document_number);

                        //     if(Person::where('document_number','=', $trozos[0])->get()){

                        //         $person = Person::orderBy('id','DESC')->where('document_number','=', $trozos[0])->get();

                        //         $accountreceiptmodel->document_number = $person->document_number;
                        //         $accountreceiptmodel->bank_number = $person->bank_account;
                        //         $accountreceiptmodel->name = $person->name.' '.$person->last_name ;
                        //         $accountreceiptmodel->user_id = $person->user->id;
                        //         $accountreceiptmodel->accounting_id = $accounting->id;

                        //     }elseif(isset($trozos[1])){

                        //         $person = Person::orderBy('id','DESC')->where('document_number','=', $trozos[1])->get();

                        //         $accountreceiptmodel->document_number = $person->document_number;
                        //         $accountreceiptmodel->bank_number = $person->bank_account;
                        //         $accountreceiptmodel->name = $person->name.' '.$person->last_name ;
                        //         $accountreceiptmodel->user_id = $person->user->id;
                        //         $accountreceiptmodel->accounting_id = $accounting->id;

                        //     }else{

                        //             return response()->json(['error' => 'Se debe Registra la Modelo con C.C. '.$bulkload->document_number.' Nombre '.$bulkload->name,
                        //             'code' => 422], 422);
                        //     }

                        // }

                        
                        if($request->has('observation')){
                            $accountreceiptmodel->observation = $request->observation;
                        }

                        if($bulkload->start != null){
                            $accountreceiptmodel->start = $bulkload->start;
                            $accountreceiptmodel->end = $bulkload->end;
                            $accountreceiptmodel->save();

                        }


                        if ($bulkload->token_mfc != null) {

                            // dd($bulkload->dolar_mfc);
                            $accountreceiptmodel->token_mfc = $bulkload->token_mfc;
                            $accountreceiptmodel->dolar_mfc = $accountreceiptmodel->token_mfc * $sites[2]->token_value;
                            $accountreceiptmodel->pesos_mfc = $accountreceiptmodel->dolar_mfc * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_mfc;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_mfc;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_mfc;

                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_chat != null) {

                            $accountreceiptmodel->token_chat = $bulkload->token_chat;
                            $accountreceiptmodel->dolar_chat = $accountreceiptmodel->token_chat * $sites[0]->token_value;
                            $accountreceiptmodel->pesos_chat = $accountreceiptmodel->dolar_chat * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_chat;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_chat;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_chat;

                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_stripchat != null) {

                            $accountreceiptmodel->token_stripchat = $bulkload->token_stripchat;
                            $accountreceiptmodel->dolar_stripchat = $accountreceiptmodel->token_stripchat * $sites[3]->token_value;
                            $accountreceiptmodel->pesos_stripchat = $accountreceiptmodel->dolar_stripchat * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_stripchat;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_stripchat;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_stripchat;
                            $accountreceiptmodel->save();
                            
                        }

                        if ($bulkload->token_camsoda != null) {

                            $accountreceiptmodel->token_camsoda = $bulkload->token_camsoda;
                            $accountreceiptmodel->dolar_camsoda = $accountreceiptmodel->token_camsoda * $sites[4]->token_value;
                            $accountreceiptmodel->pesos_camsoda = $accountreceiptmodel->dolar_camsoda * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_camsoda;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_camsoda;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_camsoda;

                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_bongas != null) {

                            $accountreceiptmodel->token_bongas = $bulkload->token_bongas;
                            $accountreceiptmodel->dolar_bongas = $accountreceiptmodel->token_bongas * $sites[7]->token_value;
                            $accountreceiptmodel->pesos_bongas = $accountreceiptmodel->dolar_bongas * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_bongas;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_bongas;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_bongas;
                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_cam4 != null) {

                            $accountreceiptmodel->token_cam4 = $bulkload->token_cam4;
                            $accountreceiptmodel->dolar_cam4 = $accountreceiptmodel->token_cam4 * $sites[1]->token_value;
                            $accountreceiptmodel->pesos_cam4 = $accountreceiptmodel->dolar_cam4 * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_cam4;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_cam4;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_cam4;
                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_jasmin != null) {

                            $accountreceiptmodel->token_jasmin = $bulkload->token_jasmin;
                            $accountreceiptmodel->dolar_jasmin = $accountreceiptmodel->token_jasmin * $sites[5]->token_value;
                            $accountreceiptmodel->pesos_jasmin = $accountreceiptmodel->dolar_jasmin * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_jasmin;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_jasmin;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_jasmin;
                            $accountreceiptmodel->save();

                        }

                        if ($bulkload->token_streamate != null) {

                            $accountreceiptmodel->token_streamate = $bulkload->token_streamate;
                            $accountreceiptmodel->dolar_streamate = $accountreceiptmodel->token_streamate * $sites[6]->token_value;
                            $accountreceiptmodel->pesos_streamate = $accountreceiptmodel->dolar_jasmin * $productionmaster->value_trm;

                            $accountreceiptmodel->token_pago += $accountreceiptmodel->token_streamate;
                            $accountreceiptmodel->dolar_pago += $accountreceiptmodel->dolar_streamate;
                            $accountreceiptmodel->pesos_pago += $accountreceiptmodel->pesos_streamate;
                            $accountreceiptmodel->save();

                        }

                        $events = Event::orderBy('id','ASC')
                        ->where('processed','=', 0)
                        ->where('event_type_id','=', 3)
                        // ->with('Provider')
                        ->orderBy('id','DESC')
                        ->get()
                        // ->pluck('Provider')
                        ->unique()
                        ->values();

                        


                        // $data = ['data'=>$events];

                        // return $this->showOne($data, 201);



                        foreach($events as $event){

                            // dd($event->value_real);
                            if($accountreceiptmodel->document_number == $event->user->person->document_number ){//TEST
                                            if($event->audit_shift_id != null){
                                                $accountreceiptmodel->auditshift += $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                            
                                            }elseif($event->audit_id != null){

                                                $accountreceiptmodel->audit = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                                                
                            
                                            }elseif($event->productiondetailsconnec_id != null){
                            
                                                $accountreceiptmodel->conection = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }elseif($event->audiovisual_id != null){
                            
                                                $accountreceiptmodel->audiovisual = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }elseif($event->production_master_id != null){
                            
                                                $accountreceiptmodel->rule_production = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }else{
                            
                                                $accountreceiptmodel->other = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                                                
                                            }

                                }elseif($accountreceiptmodel->document_number == $event->model->person->document_number){

                                            if($event->audit_shift_id != null){
                                                $accountreceiptmodel->auditshift += $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                            
                                            }elseif($event->audit_id != null){

                                                $accountreceiptmodel->audit = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                                                
                            
                                            }elseif($event->productiondetailsconnec_id != null){
                            
                                                $accountreceiptmodel->conection = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }elseif($event->audiovisual_id != null){
                            
                                                $accountreceiptmodel->audiovisual = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }elseif($event->production_master_id != null){
                            
                                                $accountreceiptmodel->rule_production = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;

                            
                                            }else{
                            
                                                $accountreceiptmodel->other = $event->value_real;
                                                $accountreceiptmodel->deductibility_total += $event->value_real;
                                                
                                            }


                                }
                            
                        }

                        // if ($bulkload->token_manyvids != null) {

                        //     $accountreceiptmodel->token_manyvids = $bulkload->token_manyvids;
                        //     $accountreceiptmodel->dolar_manyvids = $bulkload->token_manyvids * $sites[2]->token_value;
                        //     $accountreceiptmodel->pesos_manyvids = $bulkload->dolar_manyvids * $productionmaster->value_trm;

                        //     $accountreceiptmodel->token_pago += $bulkload->token_manyvids;
                        //     $accountreceiptmodel->dolar_pago += $bulkload->dolar_manyvids;
                        //     $accountreceiptmodel->pesos_pago += $bulkload->pesos_manyvids;


                        // }

                        // if ($bulkload->token_naked != null) {

                        //     $accountreceiptmodel->token_naked = $bulkload->token_naked;
                        //     $accountreceiptmodel->dolar_naked = $bulkload->token_naked * $sites[2]->token_value;
                        //     $accountreceiptmodel->pesos_naked = $bulkload->dolar_naked * $productionmaster->value_trm;

                        //     $accountreceiptmodel->token_pago += $bulkload->token_naked;
                        //     $accountreceiptmodel->dolar_pago += $bulkload->dolar_naked;
                        //     $accountreceiptmodel->pesos_pago += $bulkload->pesos_naked;

                        // }

                        // if ($bulkload->token_youporn != null) {

                        //     $accountreceiptmodel->token_youporn = $bulkload->token_youporn;
                        //     $accountreceiptmodel->dolar_youporn = $bulkload->token_youporn * $sites[2]->token_value;
                        //     $accountreceiptmodel->pesos_youporn = $bulkload->dolar_youporn * $productionmaster->value_trm;

                        //     $accountreceiptmodel->token_pago += $bulkload->token_youporn;
                        //     $accountreceiptmodel->dolar_pago += $bulkload->dolar_youporn;
                        //     $accountreceiptmodel->pesos_pago += $bulkload->pesos_youporn;

                        // }

                        // if ($bulkload->token_dirty != null) {

                        //     $accountreceiptmodel->token_dirty = $bulkload->token_dirty;
                        //     $accountreceiptmodel->dolar_dirty = $bulkload->token_dirty * $sites[2]->token_value;
                        //     $accountreceiptmodel->pesos_dirty = $bulkload->dolar_dirty * $productionmaster->value_trm;

                        //     $accountreceiptmodel->token_pago += $bulkload->token_dirty;
                        //     $accountreceiptmodel->dolar_pago += $bulkload->dolar_dirty;
                        //     $accountreceiptmodel->pesos_pago += $bulkload->pesos_dirty;

                        // }
                        
                        $accountreceiptmodel->retefuente = $accountreceiptmodel->pesos_pago * 0.04;
                        $accountreceiptmodel->total_pesos = $accountreceiptmodel->pesos_pago - $accountreceiptmodel->deductibility_total;//se le saca los deducibles

                        $accountreceiptmodel->total_pago = $accountreceiptmodel->total_pesos - $accountreceiptmodel->retefuente;
                        $accountreceiptmodel->save();

                        $accountreceiptmodel->save();
                        $accountreceiptmodelAll[] = $accountreceiptmodel->id;
                        
                }
            }

            $accountreceiptmodelAll = AccountReceiptModel::find($accountreceiptmodelAll);
            $this->earningsModels($accountreceiptmodelAll);

            // $data = ['data'=>$accountreceiptmodelAll];
            // return $this->showOne($data, 201);


            $pdf = PDF::loadView('pdf.accountreceiptmodelAll', compact('accountreceiptmodelAll'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('cuentas-cobro-modelo.pdf');

    

    }

    public function show(Request $request, AccountReceiptModel $accountreceiptmodel)
    {
        if ($request->has('pdf')) {

            $pdf = PDF::loadView('pdf.accountreceiptmodel', compact('accountreceiptmodel'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
            return $pdf->download('cuenta-cobro-modelo.pdf');
        }

        $data = ['data'=>$accountreceiptmodel];
        return $this->showOne($data);

    }

    // public function update(Request $request, AccountReceiptModel $accountreceiptmodel)
    // {
    //     $accountreceiptmodel->fill($request->all())->save();
    //     return $this->showOne($accountreceiptmodel);
    // }

    // public function destroy(AccountReceiptModel $accountreceiptmodel)
    // {
    //     $accountreceiptmodel->delete($accountreceiptmodel);
    //     return $this->showOne($accountreceiptmodel);
    // }


    public function earningsModels($accountreceiptmodelAll)//CUENTA DE COBRO, este metodo debe ser probado pasando la variable
    {


     
        $company = Company::findOrFail(1);

        $typesatelite = [2,3,4];

        $users = $company->user()// todas las modelos de la compañea 1
        ->whereHas('person.provider.jobtype')
        ->with('person.provider.jobtype')
        ->orderBy('id','DESC')
        ->get()
        ->whereIn('person.provider.jobtype.id',$typesatelite) //TODO: sirve en uno solo
        // ->pluck('user')
        // ->collapse()
        // ->whereIn('id',$modelossatelite) //TODO: sirve en uno solo
        ->unique()
        ->values();

        // $data = ['data'=>$users];
        // return $this->showOne($data, 201);

        $earning = 0;

        foreach($accountreceiptmodelAll as $accountreceiptmodel){

            foreach($users as $user){

                    if($accountreceiptmodel->user_id == $user->id){

                            $earning = $accountreceiptmodel->total_pago;

                                $billtopay = new BillToPay();
                                $billtopay->description = 'calculo de la produccion por carga masiva';
                                // $billtopay->way_to_pay = $request->way_to_pay;
                                // $billtopay->transfer_code = $request->transfer_code;
                                // $billtopay->quantity = $request->quantity;
                                $billtopay->total_cost = $earning;
                                $billtopay->production_system = 1;
                                $billtopay->accounting_id = $accountreceiptmodel->accounting_id;
                                // $billtopay->event_id = $event->id;
                                $billtopay->user_id = $user->id;
                                $billtopay->save();

                                        $billtocharge = new BillToCharge();
                                        $billtocharge->description = 'cuenta de cobro de modelo por carga masiva';
                                        $billtocharge->production_system = 1;
                                        $billtocharge->total_cost = $earning;
                                        $billtocharge->accounting_id = $accountreceiptmodel->accounting_id;
                                        // $billtocharge->event_id = $event->id;
                                        $billtocharge->bill_to_pay_id = $billtopay->id;
                                        $billtocharge->save();

                    }

             }
        }

        $data = ['data1'=>$users];
        return $this->showOne($data, 201);

    }
}
