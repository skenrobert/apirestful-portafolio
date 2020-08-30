<?php

namespace App\Http\Controllers;

use App\Models\ProductionDetailsWeek;
use Illuminate\Http\Request;

class productiondetailsweekController extends ApiController
{
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Room"]
        // ];

        // $productiondetailsweek= ProductionDetailsWeek::orderBy('id','DESC')->get();

        // $productiondetailsweek->each(function($productiondetailsweek){

        //     $productiondetailsweek->productionmaster;
        //     $productiondetailsweek->shifthasprovider->shift;
        //     $productiondetailsweek->shifthasprovider->planningprovider;

        // });



        // $data = ['data'=>$productiondetailsweek, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }
    
    public function store(Request $request)
    {
        $productiondetailsweek = ProductionDetailsWeek::create($request->all());
        return $this->showOne($productiondetailsweek, 201);
    }

    public function show(ProductionDetailsWeek $productiondetailsweek)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Semana de Produccion"]
        ];


        foreach($productiondetailsweek->shifthasplanning->monitorshift as $monitorshift){
            $monitorshift->shift;
            $monitorshift->user->person;
            $monitorshift->task;
        }

        foreach($productiondetailsweek->shifthasplanning->planningprovider as $planningprovider){
                $planningprovider->shift;
                $planningprovider->monitor->person;
                $planningprovider->room;
            }

        $data = ['data'=>$productiondetailsweek, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }


    public function update(Request $request, ProductionDetailsWeek $productiondetailsweek)
    {
        $productiondetailsweek->fill($request->all())->save();
        return $this->showOne($productiondetailsweek);
    }

    public function destroy(ProductionDetailsWeek $productiondetailsweek)
    {
        //   $productiondetailsweek->delete($productiondetailsweek);
        // return $this->showOne($productiondetailsweek);
    }
}
