<?php

namespace App\Http\Controllers;

use App\Models\ProductionDetailsShift;
use App\Models\ProductionDetailsDay;
use App\Models\ProductionMaster;
use Illuminate\Http\Request;

class ProductionDetailsShiftController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Produccion por Turno"]
        // ];

        // $productiondetailsshift= ProductionDetailsShift::orderBy('id','DESC')->get();

        //  $productiondetailsshift->each(function($productiondetailsshift){

        // //     foreach ($productiondetailsshift->productiondetailsconnec as $productiondetailsconnec) {// m a n
        // //             $productiondetailsconnec->accountproductiondetails;
        // //         }

        // //     // $productiondetailsshift->monitorshift->person;
        //     $productiondetailsshift->shift;

        // });

        // // $productiondetailsconnec->accountproductiondetails;

        // $data = ['data'=>$productiondetailsshift, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }

    public function store(Request $request)
    {
        // $productiondetailsshift = ProductionDetailsShift::create($request->all());
        // return $this->showOne($productiondetailsshift, 201);
    }

    public function show(ProductionDetailsShift $productiondetailsshift)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Produccion de Turno"]
        ];

        foreach ($productiondetailsshift->productiondetailsconnec as $productiondetailsconnec) {// m a n
            $productiondetailsconnec->accountproductiondetails;
        }
            $productiondetailsshift->monitorshift->person;
            $productiondetailsshift->shift;
            $productiondetailsshift->productiondetailsday;

        $data = ['data'=>$productiondetailsshift, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }
    // productiondetailsshift
  

    public function update(Request $request, ProductionDetailsShift $productiondetailsshift)
    {


        if($productiondetailsshift->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $productiondetailsshift->fill($request->all())->save();

        $productiondetailsday = ProductionDetailsDay::findOrFail($productiondetailsshift->production_details_day_id);
        $productiondetailsday->dolar_total_day = $productiondetailsday->dolar_total_day + $productiondetailsshift->dolar_total_monitor_shift;
        $productiondetailsday->tkn_total_day = $productiondetailsday->tkn_total_day + $productiondetailsshift->tkn_total_monitor;
        $productiondetailsday->save();

        $productionmaster = ProductionMaster::findOrFail($productiondetailsshift->production_details_day_id);
        $productionmaster->tkn_total_week = $productionmaster->tkn_total_week + $productiondetailsday->tkn_total_day;
        $productionmaster->dolar_total_week = $productionmaster->dolar_total_week + $productiondetailsday->dolar_total_day;
        $productionmaster->save();


        return $this->showOne($productiondetailsshift);
    }

    public function destroy(ProductionDetailsShift $productiondetailsshift)
    {
        // $productiondetailsshift->delete($productiondetailsshift);
        // return $this->showOne($productiondetailsshift);
    }
}
