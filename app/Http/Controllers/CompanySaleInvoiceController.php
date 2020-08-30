<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanySaleInvoiceController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Company $company)
    {
        $saleinvoice = $company->shops()
        //  ->whereHas('shops')
        ->with('bill_to_charge.sale_invoice')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values();

        $data = ['data'=>$saleinvoice];
        return $this->showAll($data);
    }
}
