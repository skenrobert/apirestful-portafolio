<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class CompanyPurchaseOrderController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
       
        $purchaseorder = $company->purchaseorders()
        // ->whereHas('Provider')
        // ->with('Provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$purchaseorder];
        return $this->showAll($data);
    }

   
    public function update(Request $request, Company $company, PurchaseOrder $purchaseorder)
    {
        
        $purchaseorder->items()->attach($request->purchaseorder_id, ['quantity' => $request->quantity,'price' => $request->price]);
       
        $purchaseorder->items;

        return $this->showAll($purchaseorder);

    }

    // public function destroy(Company $company, Provider $provider)
    // {
    //      //se elimina la relación en la tabla pivote

    //     //TODO: debe eliminar de la tabla empleado el registro
    //     if(!$company->people()->find($provider->person_id))
    //     {
    //         return $this->errorResponse("El Empleado especificado no trabaja en esa empresa",404);
    //     }

    //     $company->people()->detach($provider->person_id);
    //     // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
    //     $company->people;
    //     return $this->showAll($company);

    // }
}
