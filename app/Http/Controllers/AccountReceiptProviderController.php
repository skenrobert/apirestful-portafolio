<?php

namespace App\Http\Controllers;

use App\Models\AccountReceiptProvider;
use App\Models\Provider;
use App\Models\Event;
use App\Models\Company;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;


class AccountReceiptProviderController extends ApiController
{
    public function __construct()//TODO: se deshabilita para probar el json
    {
        // $this->middleware('auth:api');
        // parent::__construct();
        $this->middleware('MonologMiddleware');

    }
   
    public function index()
    {
        // $accountreceiptproviders= AccountReceiptProvider::orderBy('id','DESC')->get();
        // $data = ['data'=>$accountreceiptproviders];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {

        $provider= Provider::find($request->provider_id);
        $company= Company::find($request->company_id);

        $event = new Event();
        $event->processed = 1;
        // $event->productionmaster_id = $productionmaster->id;
        $event->observation = 'Calcula y Pago a los Provedores de Servicio Nombre '.$provider->person->name.' Numero de CC.: '. $provider->person->document_number;
        $event->event_type_id = 8;
        $event->save();

        $accountreceiptprovider = new AccountReceiptProvider();

        $accountreceiptprovider->control_number = $company->control_number_provider + 1;

        $accountreceiptprovider->document_number = $provider->person->document_number;
        $accountreceiptprovider->name = $provider->person->name .' '. $provider->person->last_name;

        $accountreceiptprovider->bank_number = $provider->person->bank_account_type .' Del Banco '. $provider->person->banks->name.' NRO '.$provider->person->bank_account;
        $accountreceiptprovider->concept = $request->concept;
        $accountreceiptprovider->value = $request->value;
        $accountreceiptprovider->rte_fte = $request->value * 0.06;
        $accountreceiptprovider->rete_ica = ($request->value * 10)/1000;
        $accountreceiptprovider->value_pay = $request->value - ( ($request->value * 0.06) + ($request->value * 10)/1000);
        $accountreceiptprovider->value_pay_tex = $request->value_pay_tex;
        $accountreceiptprovider->event_id = $event->id;
        $accountreceiptprovider->provider_id = $provider->id;
        $accountreceiptprovider->company_id = $company->id;
        $accountreceiptprovider->save();


        $company->control_number_provider = $company->control_number_provider + 1;
        $company->save();

        $pdf = PDF::loadView('pdf.accountreceiptprovider', compact('accountreceiptprovider'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
        return $pdf->download('cuenta-cobro-proveedor-servicio.pdf');
       
        //   $data = ['data'=>$accountreceiptprovider];
        //   return $this->showOne($data);
    }

    public function show(Request $request, AccountReceiptProvider $accountreceiptprovider)
    {

        // if ($request->has('pdf')) {

            $pdf = PDF::loadView('pdf.accountreceiptprovider', compact('accountreceiptprovider'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global
            return $pdf->download('cuenta-cobro-proveedor-servicio.pdf');
        // }
        
        $data = ['data'=>$accountreceiptprovider];
        return $this->showOne($data);
    }

    // public function update(Request $request, AccountReceiptProvider $accountreceiptprovider)
    // {

    //       $accountreceiptprovider->fill($request->all())->save();

    //       $data = ['data'=>$accountreceiptprovider];
    //       return $this->showOne($data);
    // }

    public function destroy(AccountReceiptProvider $accountreceiptprovider)
    {
        $accountreceiptprovider->delete($accountreceiptprovider);
        return $this->showOne($accountreceiptprovider);
    }
}
