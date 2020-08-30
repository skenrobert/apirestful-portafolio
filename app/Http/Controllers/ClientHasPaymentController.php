<?php

namespace App\Http\Controllers;

use App\Models\ClientHasPayment;
use Illuminate\Http\Request;

class ClientHasPaymentController extends ApiController
{
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Cuentas por Cobrar"]
    //     ];

    //     $clienthaspayments= ClientHasPayment::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$clienthaspayments, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);

    // }

    // public function store(Request $request)
    // {
    //     $clienthaspayment = ClientHasPayment::create($request->all());
    //     return $this->showOne($clienthaspayment, 201);
    // }

    public function show(ClientHasPayment $clienthaspayment)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Cuenta Por Cobrar"]
        ];

        $data = ['data'=>$clienthaspayment, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    // public function update(Request $request, ClientHasPayment $clienthaspayment)
    // {
    //     $clienthaspayment->fill($request->all())->save();
    //     return $this->showOne($clienthaspayment);
    // }

    // public function destroy(ClientHasPayment $clienthaspayment)
    // {
    //     $clienthaspayment->delete($clienthaspayment);
    //     return $this->showOne($clienthaspayment);
    // }
}
