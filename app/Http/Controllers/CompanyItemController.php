<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Item;

class CompanyItemController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $items = $company->items()
        //  ->whereHas('items')
        ->with('taxes')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('item')
        ->unique()
        ->values();

        $data = ['data'=>$items];
        return $this->showAll($data);
    }

    public function destroy(Request $request, Company $company, Item $item)
    {

        if(!$company->items()->find($item->id))
        {
            return $this->errorResponse("El Articulo especificado no esta Asociado a esa empresa",404);
        }

        $item->taxes()->detach($request->tax_id);
        $item->taxes;
        return $this->showAll($item);
    }
}
