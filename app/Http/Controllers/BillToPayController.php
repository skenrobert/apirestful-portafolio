<?php

namespace App\Http\Controllers;

use App\Models\BillToPay;
use Illuminate\Http\Request;

class BillToPayController extends ApiController
{
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de BillToPay"]
    //     ];

    //     // $billtopay = BillToPay::orderBy('id','DESC');   
    //     // $billtopay = BillToPay::orderBy('id','ASC')->pluck('number', 'location', 'id');
    //     $billtopay= BillToPay::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$billtopay, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    public function store(Request $request)
    {
        $billtopay = BillToPay::create($request->all());
        //generar el primer abono de una vez

        return $this->showOne($billtopay, 201);
    }

    public function show(BillToPay $billtopay)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Cuentas por Pagar"]
        ];

        $billtopay->owner->person;

        $data = ['data'=>$billtopay, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, BillToPay $billtopay)
    {
        $billtopay->fill($request->all())->save();
        return $this->showOne($billtopay);
    }

    public function destroy(BillToPay $billtopay)
    {
        $billtopay->delete($billtopay);
        return $this->showOne($billtopay);
    }
}
