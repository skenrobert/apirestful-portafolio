<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
        // ];

        // $purchaseorder = PurchaseOrder::all();

          
        // $data = ['data'=>$purchaseorder, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $purchaseorder = PurchaseOrder::create($request->all());
        return $this->showOne($purchaseorder, 201);
    }

    public function show(PurchaseOrder $purchaseorder)
    {
        $data = ['data'=>$purchaseorder];
        return $this->showOne($data);
    }

    public function update(Request $request, PurchaseOrder $purchaseorder)
    {
        $purchaseorder->fill($request->all())->save();
        return $this->showOne($purchaseorder);
    }

    public function destroy(PurchaseOrder $purchaseorder)
    {
        $purchaseorder->delete($purchaseorder);
        return $this->showOne($purchaseorder);
    }
}
