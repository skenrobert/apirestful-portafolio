<?php

namespace App\Http\Controllers;

use App\Models\ProductionDetailsDay;
use App\Models\ProductionMaster;
use Illuminate\Http\Request;

class ProductionDetailsDayController extends ApiController
{

    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Room"]
        // ];

        // $productiondetailsday= ProductionDetailsDay::orderBy('id','DESC')->get();

        // $productiondetailsday->each(function($productiondetailsday){

        // $productiondetailsday->production_details_week;

        // });



        // $data = ['data'=>$productiondetailsday, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }

    public function store(Request $request)
    {
        // $productiondetailsday = ProductionDetailsDay::create($request->all());
        // return $this->showOne($productiondetailsday, 201);
    }

    public function show(ProductionDetailsDay $productiondetailsday)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Room"]
        ];

        foreach ( $productiondetailsday->productiondetailsshift as $productiondetailsshift) {// m a n
            $productiondetailsshift->shift;
            $productiondetailsshift->monitorshift->person;
        }
            $productiondetailsday->production_details_week;

        $data = ['data'=>$productiondetailsday, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }


    public function update(Request $request, ProductionDetailsDay $productiondetailsday)
    {

        if($productiondetailsday->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $productiondetailsday->fill($request->all())->save();

        $productionmaster = ProductionMaster::findOrFail($productiondetailsshift->production_details_day_id);
        $productionmaster->tkn_total_week = $productionmaster->tkn_total_week + $productiondetailsday->tkn_total_day;
        $productionmaster->dolar_total_week = $productionmaster->dolar_total_week + $productiondetailsday->dolar_total_day;
        $productionmaster->save();

        return $this->showOne($productiondetailsday);
    }

    public function destroy(ProductionDetailsDay $productiondetailsday)
    {
          // $productiondetailsday->delete($productiondetailsday);
        // return $this->showOne($productiondetailsday);
    }
}
