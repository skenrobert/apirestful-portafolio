<?php

namespace App\Http\Controllers;

use App\Models\ComissionEmployee;
use Illuminate\Http\Request;

class ComissionEmployeeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    // public function index()
    // {
       
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de % de Comisiones"]
    //     ];

    //     $comissionemployee = ComissionEmployee::orderBy('id','DESC')->get();

    //     $data = ['data'=>$comissionemployee, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);
    // }

    // public function store(Request $request)
    // {
    //     $comissionemployee = Eps::create($request->all());
    //     return $this->showOne($comissionemployee, 201);
        
    // }

    public function show(ComissionEmployee $comissionemployee)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Comisiones"]
        ];
        // dd($eps);

        $data = ['data'=>$comissionemployee, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, ComissionEmployee $comissionemployee)
    {
        $comissionemployee->fill($request->all())->save();
        return $this->showOne($comissionemployee);
    }

    public function destroy(ComissionEmployee $comissionemployee)
    {
        $comissionemployee->delete($comissionemployee);
        return $this->showOne($comissionemployee);
    }
}
