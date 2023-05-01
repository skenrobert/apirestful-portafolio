<?php

namespace App\Http\Controllers;

// use App\Models\ShiftHasProvider;
use App\Models\PlaninngProvider;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ShiftHasProviderController extends ApiController
{
  
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Provedores"]
        ];
     
        $shifthasprovider= ShiftHasProvider::orderBy('id','DESC')->get();

        $shifthasprovider->each(function($shifthasprovider){
            $shifthasprovider->planningprovider;
            $shifthasprovider->shift;
        // // $shifthasemployees->monitorshift->employee;


          });
        
        $data = ['data'=>$shifthasprovider, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }
   
    public function store(Request $request)
    {
        
        // $shifthasprovider = ShiftHasProvider::create($request->all());
      
        //  //TODO: debe crearse por todo los turno de una vez
         $knownDate = Carbon::now();
         $knownDate = new Carbon('next monday');
       
         $shifthasemployee = ShiftHasProvider::create($request->all());
         $shifthasemployee->beginning_week = $knownDate->format('Y-m-d');  
         $shifthasemployee->end_week = $knownDate->endOfWeek()->format('Y-m-d');  


        $data = ['data'=>$shifthasprovider];
        return $this->showOne($data, 201);
    }

   
    public function show(ShiftHasProvider $shifthasprovider)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Provedor"]
        ];

        $shifthasprovider->planinngprovider;
        $shifthasprovider->shift;

        $data = ['data'=>$shifthasprovider, 'breadcrumbs'=> $breadcrumbs];

        return $this->showOne($data);
    }
   
    public function update(Request $request, ShiftHasProvider $shifthasprovider)
    {
        // $shifthasprovider->fill($request->all())->save();
        if($request->has('observation')){
            $shifthasprovider->observation = $request->description;
        }
        if($request->has('goal_week')){
            $shifthasprovider->goal_week = $request->goal_week;
        }
        $shifthasemployee->save();
        return $this->showOne($shifthasprovider);
    }

    public function destroy(ShiftHasProvider $shifthasprovider)
    {
        $shifthasprovider->delete($shifthasprovider);
        return $this->showOne($shifthasprovider);
    }

    // Return Shift View
 
    public function shift_list(ShiftHasProvider $shifthasprovider)
    {
        $breadcrumbs = [
            ['link'=>"dashboard",'name'=>"Inicio"], ['name'=>"Todos los Horarios de Modelos"]
        ];

        return view('/pages/app-shift-providers-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
