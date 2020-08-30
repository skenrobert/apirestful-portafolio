<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends ApiController
{
   
    public function index()
    {
       
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
        ];

        $shift = Shift::all();

          
        $data = ['data'=>$shift, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $shift = Shift::create($request->all());
        return $this->showOne($shift, 201);
    }

    public function show(Shift $shift)
    {
        $data = ['data'=>$shift];
        return $this->showOne($data);
    }

    public function update(Request $request, Shift $shift)
    {
        $shift->fill($request->all())->save();
        return $this->showOne($shift);
    }

    // public function destroy(Shift $shift)
    // {
    //     $shift->delete($shift);
    //     return $this->showOne($shift);
    // }
}
