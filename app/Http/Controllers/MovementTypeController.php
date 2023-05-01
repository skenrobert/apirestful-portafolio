<?php

namespace App\Http\Controllers;

use App\Models\MovementType;
use Illuminate\Http\Request;

class MovementTypeController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
   public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Tipos de Movimientos de Inventario"]
        ];

        $movementtypes = MovementType::orderBy('id','DESC')->get();
          
        $data = ['data'=>$movementtypes, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    // public function store(Request $request)
    // {
    //     $movementtype = MovementType::create($request->all());
    //     return $this->showOne($movementtype, 201);
    // }

    public function show(MovementType $movementtype)
    {        
        $data = ['data'=>$movementtype];
        return $this->showOne($data);
    }

    public function update(Request $request, MovementType $movementtype)
    {
        $movementtype->fill($request->all())->save();
        return $this->showOne($movementtype);
    }

    // public function destroy(MovementType $movementtype)
    // {
    //     // $movementtype = MovementType::findOrfail($id);
    //     $movementtype->delete($movementtype);
    //     return $this->showOne($movementtype);
    // }
}
