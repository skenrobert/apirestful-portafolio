<?php

namespace App\Http\Controllers;

use App\Models\Commission;

use Illuminate\Http\Request;

class CommissionController extends ApiController
{
   
    public function index()
    {
       
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de % de Comisiones"]
        ];

        $commission = Commission::orderBy('id','DESC')->get();

        $data = ['data'=>$commission, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    // public function store(Request $request)
    // {
    //     $commission = Eps::create($request->all());
    //     return $this->showOne($commission, 201);
        
    // }

    public function show(Commission $commission)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Comisiones"]
        ];
        // dd($eps);

        $data = ['data'=>$commission, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Commission $commission)
    {
        $commission->fill($request->all())->save();
        return $this->showOne($commission);
    }

    // public function destroy(Eps $commission)
    // {
    //     $commission->delete($commission);
    //     return $this->showOne($commission);
    // }


}
