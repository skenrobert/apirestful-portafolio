<?php

namespace App\Http\Controllers;

use App\Models\ProductionMaster;
use Illuminate\Http\Request;

class ProductionMasterController extends ApiController
{

    public function __construct()//TODO: se deshabilita para probar el json
    {
        $this->middleware('auth:api');
        // parent::__construct();
        // $this->middleware('transform.input:'. UserTransformer::class)->only(['store', 'update']);
    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Room"]
        // ];

        // $productionmasters= ProductionMaster::orderBy('id','DESC')->get();

        // $productionmasters->each(function($productionmasters){
    
        //     foreach ($productionmasters->productiondetailsweek as $productiondetailsweek) {// m a n
        //         $productiondetailsweek->productiondetailsday;
        //     }
        //     $productionmasters->commission;

        // });

        // $data = ['data'=>$productionmasters, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }
    
    // public function store(Request $request)
    // {
    //     $productionmaster = ProductionMaster::create($request->all());
    //     return $this->showOne($productionmaster, 201);
        
    // }

    public function show(ProductionMaster $productionmaster)
    {
    //         $productionmaster->commission;
         
    //     foreach ($productionmaster->productiondetailsweek as $productiondetailsweek) {// m a n
    //         foreach ($productiondetailsweek->productiondetailsday as $productiondetailsday) {// m a n
    //             foreach ($productiondetailsday->productiondetailsshift as $productiondetailsshift) {// m a n
    //                 foreach ($productiondetailsshift->productiondetailsconnec as $productiondetailsconnec) {// m a n

    //                 $productiondetailsconnec->accountproductiondetails;
    //             }
    //         }
    //     }
    // }
        $data = ['data'=>$productionmaster];
        return $this->showOne($data);
    }


    public function update(Request $request, ProductionMaster $productionmaster)
    {
        if($productionmaster->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
             'code' => 422], 422);
        }

        $productionmaster->dolar_week_default = $request->dolar_week_default;
        $productionmaster->estimated = $request->estimated;
        $productionmaster->minimum_limit = $request->minimum_limit;
        $productionmaster->tkn_week_default = $request->tkn_week_default;
        $productionmaster->tkn_week_news = $request->tkn_week_news;
        $productionmaster->value_trm = $request->value_trm;
        $productionmaster->observation_week = $request->observation_week;
        $productionmaster->save();

        return $this->showOne($productionmaster);
    }

    public function destroy(ProductionMaster $productionmaster)
    {
          // $productionmaster->delete($productionmaster);
        // return $this->showOne($productionmaster);
    }
}