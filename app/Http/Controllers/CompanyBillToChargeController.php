<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ClientHasPayment;
use App\Models\BillToCharge;
use Illuminate\Http\Request;

class CompanyBillToChargeController extends ApiController
{
    public function index(Company $company)
    {
        $billtocharge = $company->accounting()
         ->whereHas('billtocharge')
        ->with('billtocharge.clienthaspayment.person')
        ->orderBy('id','DESC')
        ->get()
        ->where('production_system','=',0)
        ->pluck('billtocharge')
        ->collapse()
        ->unique()
        ->values();

        $data = ['data'=>$billtocharge];
        return $this->showAll($data);
    }

    public function store(Request $request, Company $company)
    {

        $clienthaspayment = New ClientHasPayment();

        if($request->has('description')){
            $clienthaspayment->description = $request->description;
        }

        if($request->has('payment_method')){
            $clienthaspayment->payment_method = $request->payment_method;
        }

        if($request->has('transfer_code')){
            $clienthaspayment->transfer_code = $request->transfer_code;
        }
       
        if($request->has('dues')){
            $clienthaspayment->dues = $request->dues;
        }
       
        if($request->has('paid')){
            $clienthaspayment->paid = $request->paid;
        }

        if($request->has('person_id')){
            $clienthaspayment->person_id = $request->person_id;
        }


        $billtocharge = BillToCharge::find($request->bill_to_charge_id);

        $clienthaspayment->bill_to_charge_id = $billtocharge->id;
        $clienthaspayment->save();

        $billtocharge->total_paid += $request->paid;
        $billtocharge->save();

        $billtocharge->clienthaspayment;
      

        $data = ['data'=>$billtocharge];
        return $this->showAll($data);

    }

    public function update(Request $request, Company $company, $id)
    {

        $clienthaspayment = ClientHasPayment::find($id);
        $billtocharge = $clienthaspayment->bill_to_charge;
        $billtocharge->total_paid = $billtocharge->total_paid - $clienthaspayment->paid;
        $billtocharge->save();


        if($request->has('description')){
            $clienthaspayment->description = $request->description;
        }

        if($request->has('payment_method')){
            $clienthaspayment->payment_method = $request->payment_method;
        }

        if($request->has('transfer_code')){
            $clienthaspayment->transfer_code = $request->transfer_code;
        }
       
        if($request->has('dues')){
            $clienthaspayment->dues = $request->dues;
        }
       
        if($request->has('paid')){
            $clienthaspayment->paid = $request->paid;
        }

        if($request->has('person_id')){
            $clienthaspayment->person_id = $request->person_id;
        }


        $clienthaspayment->save();

        $billtocharge->total_paid += $request->paid;
        $billtocharge->save();

        $billtocharge->clienthaspayment;
      
        $data = ['data'=>$billtocharge];
        return $this->showAll($data);

    }


    public function destroy(Request $request, Company $company, $id)
    {

        $clienthaspayment = ClientHasPayment::find($id);
        $billtocharge = $clienthaspayment->bill_to_charge;
        $billtocharge->total_paid = $billtocharge->total_paid - $clienthaspayment->paid;
        $billtocharge->save();
                
        $clienthaspayment->delete($clienthaspayment);

        $billtocharge->clienthaspayment;
      
        $data = ['data'=>$billtocharge];
        return $this->showAll($data);

    }
}
