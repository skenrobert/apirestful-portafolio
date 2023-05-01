<?php

namespace App\Http\Controllers;

use App\Models\BillToPay;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyBilltoPayController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $billtopay = $company->accounting()
         ->whereHas('billtopay')
        ->with('billtopay.owner')
        ->orderBy('id','DESC')
        ->get()
        ->where('production_system','=',0)
        ->pluck('billtopay')
        ->collapse()
        ->unique()
        ->values();

        $data = ['data'=>$billtopay];
        return $this->showAll($data);
    }

    public function update(Request $request, Company $company, BillToPay $billtopay)
    {

        $billtopay->users()->attach($request->user_id, ['paid' => $request->paid]);

        $total_paid = $billtopay->users()->sum('paid');

        $billtopay->total_paid += $total_paid;
        $billtopay->billtocharge->total_paid += $total_paid;

        $billtopay->save();
       
        $billtopay->users;
        $billtopay->billtocharge;

        return $this->showAll($billtopay);

    }


    public function destroy(Request $request, Company $company, BillToPay $billtopay)
    {
        if(!$billtopay->users()->find($request->user_id))
        {
            return $this->errorResponse("El Empleado especificado no tiene cuenta por cobrar",404);
        }

        $billtopay->users()->detach($request->user_id);
        // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
        $billtopay->users;
        return $this->showAll($billtopay);
    }

}
