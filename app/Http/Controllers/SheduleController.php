<?php

namespace App\Http\Controllers;

use App\Models\Shedule;
use Illuminate\Http\Request;

class SheduleController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Shedule"]
        ];

        // $shedules = Shedule::orderBy('id','DESC');   
        // $shedules = Shedule::orderBy('id','ASC')->pluck('number', 'location', 'id');
        $shedules= Shedule::orderBy('id','DESC')->get();
          
        $data = ['data'=>$shedules, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }

    public function store(Request $request)
    {
        $shedule = Shedule::create($request->all());
        return $this->showOne($shedule, 201);
    }

    public function show(Shedule $shedule)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Shedule"]
        ];

        $data = ['data'=>$shedule, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Shedule $shedule)
    {
        $shedule->fill($request->all())->save();
        return $this->showOne($shedule);
    }

    public function destroy(Shedule $shedule)
    {
        $shedule->delete($shedule);
        return $this->showOne($shedule);
    }
}
