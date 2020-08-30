<?php

namespace App\Http\Controllers;

use App\Models\ReceiptPayment;
use Illuminate\Http\Request;

class ReceiptPaymentController extends ApiController
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
        // ];

        // $receiptpayment = ReceiptPayment::all();

          
        // $data = ['data'=>$receiptpayment, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $receiptpayment = ReceiptPayment::create($request->all());
        return $this->showOne($receiptpayment, 201);
    }

    public function show(ReceiptPayment $receiptpayment)
    {
        $data = ['data'=>$receiptpayment];
        return $this->showOne($data);
    }

    public function update(Request $request, ReceiptPayment $receiptpayment)
    {
        $receiptpayment->fill($request->all())->save();
        return $this->showOne($receiptpayment);
    }

    // public function destroy(ReceiptPayment $receiptpayment)
    // {
    //     $receiptpayment->delete($receiptpayment);
    //     return $this->showOne($receiptpayment);
    // }
}
