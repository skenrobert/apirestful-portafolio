<?php

namespace App\Http\Controllers;

use App\Models\BillToCharge;
use App\Models\ClientHasPayment;

use Illuminate\Http\Request;

class BillToChargeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');
    }
    
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de BillToCharge"]
    //     ];

    //     // $billtocharge = BillToCharge::orderBy('id','DESC');   
    //     // $billtocharge = BillToCharge::orderBy('id','ASC')->pluck('number', 'location', 'id');
    //     $billtocharge= BillToCharge::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$billtocharge, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    public function store(Request $request)
    {
        $billtocharge = BillToCharge::create($request->all());

        $clienthaspayment = new ClientHasPayment();
        $clienthaspayment->payment_method = $request->payment_method;
        $clienthaspayment->description = $request->description;
        $clienthaspayment->dues = $request->dues;
        $clienthaspayment->person_id = $request->person_id;
        $clienthaspayment->bill_to_charge_id = $billtocharge->id;

        if($request->has('transfer_code')){
            $clienthaspayment->transfer_code = $request->transfer_code;
            
        }

        $clienthaspayment->save();

        $data = ['data'=>$billtocharge, 'data1'=> $clienthaspayment];

        return $this->showOne($data, 201);
    }

    public function show(BillToCharge $billtocharge)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Cuentas por Pagar"]
        ];

        $data = ['data'=>$billtocharge, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, BillToCharge $billtocharge)
    {
        $BillToCharge->fill($request->all())->save();
        return $this->showOne($billtocharge);
    }

    public function destroy(BillToCharge $billtocharge)
    {
        $BillToCharge->delete($billtocharge);
        return $this->showOne($billtocharge);
    }
}
