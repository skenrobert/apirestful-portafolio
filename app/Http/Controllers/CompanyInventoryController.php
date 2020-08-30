<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyInventoryController extends ApiController
{
    public function index(Company $company)
    {
        $inventory = $company->inventory()
        //  ->whereHas('items')
        // ->with('taxes')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('item')
        ->unique()
        ->values();

        $data = ['data'=>$inventory];
        return $this->showAll($data);
    }
}
