<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends ApiController
{
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Impuestos"]
        ];

        $taxes = Tax::orderBy('id','DESC')->get();
          
        $data = ['data'=>$taxes, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    // public function store(Request $request)
    // {
    //     $taxe = Tax::create($request->all());
    //     return $this->showOne($taxe, 201);
    // }

    public function show(Taxe $tax)
    {        
        $data = ['data'=>$tax];
        return $this->showOne($data);
    }

    public function update(Request $request, Taxe $tax)
    {
        $tax->fill($request->all())->save();
        return $this->showOne($tax);
    }

    // public function destroy(Tax $tax)
    // {
    //     // $tax = Tax::findOrfail($id);
    //     $tax->delete($tax);
    //     return $this->showOne($tax);
    // }
}
