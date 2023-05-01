<?php

namespace App\Http\Controllers;

use App\Models\CompareProviderWeek;
use Illuminate\Http\Request;

class CompareProviderWeekController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Room"]
        // ];

        // $compareproviderweeks= CompareProviderWeek::orderBy('id','DESC')->get();

        // $compareproviderweeks->each(function($compareproviderweeks){//1 a 1

        //     $compareproviderweeks->productiondetailsweek;
        //     $compareproviderweeks->provider;
        //     $compareproviderweeks->employee;

        // });


        // $data = ['data'=>$compareproviderweeks, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);

    }
    
    public function store(Request $request)
    {
        $compareproviderweek = CompareProviderWeek::create($request->all());
        return $this->showOne($compareproviderweek, 201);
    }

    public function show(CompareProviderWeek $compareproviderweek)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Comparacion de Semana"]
        ];


        $compareproviderweek->production_details_week;
        $compareproviderweek->provider;
        $compareproviderweek->employee;


        $data = ['data'=>$compareproviderweek, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }


    public function update(Request $request, CompareProviderWeek $compareproviderweek)
    {
        $compareproviderweek->fill($request->all())->save();
        return $this->showOne($compareproviderweek);
    }

    public function destroy(CompareProviderWeek $compareproviderweek)
    {
          $compareproviderweek->delete($compareproviderweek);
        return $this->showOne($compareproviderweek);
    }
}
