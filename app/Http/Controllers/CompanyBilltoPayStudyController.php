<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\BillToPay;
use Illuminate\Http\Request;

class CompanyBilltoPayStudyController extends ApiController
{
    public function index(Company $company)
    {
        $billtopay = $company->accounting()
        ->whereHas('billtopay')
        ->with('billtopay.study.companytype')
        ->orderBy('id','DESC')
        ->get()
        ->pluck('billtopay')
        ->collapse()
        ->unique()
        ->values();

        $data = ['data'=>$billtopay];
        return $this->showAll($data);
    }

    public function update(Request $request, Company $company, BillToPay $billtopay, Company $study)
    {

        $billtopay->study()->attach($study->id, ['paid' => $request->paid]);

        $total_paid = $billtopay->study()->sum('paid');

        $billtopay->total_paid += $total_paid;
        $billtopay->billtocharge->total_paid += $total_paid;

        $billtopay->save();

        $billtopay->study;
        $billtopay->billtocharge;

        return $this->showAll($billtopay);

    }


    public function destroy(Request $request, Company $company, BillToPay $billtopay, Company $study)
    {
        if(!$billtopay->study()->find($study->id))
        {
            return $this->errorResponse("El Empleado especificado no tiene cuenta por cobrar",404);
        }

        $billtopay->study()->detach($study->id);
        // $provider->delete($provider);// si el ide de persona aperece una vez en la tabla pivot
        $billtopay->study;
        return $this->showAll($billtopay);
    }
}
