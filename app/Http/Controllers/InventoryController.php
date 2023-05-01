<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    // public function index()
    // {
    //     $breadcrumbs = [
    //         ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Tipos de Eventos"]
    //     ];

    //     $inventorys = Inventory::orderBy('id','DESC')->get();
          
    //     $data = ['data'=>$inventorys, 'breadcrumbs'=> $breadcrumbs];
    //     return $this->showAll($data);
    // }

    // public function store(Request $request)
    // {
    //     $inventory = Inventory::create($request->all());
    //     return $this->showOne($inventory, 201);
    // }

    public function show(Inventory $inventory)
    {        
        $data = ['data'=>$inventory];
        return $this->showOne($data);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $inventory->fill($request->all())->save();
        return $this->showOne($inventory);
    }

    // public function destroy(Inventory $inventory)
    // {
    //     // $inventory = Inventory::findOrfail($id);
    //     $inventory->delete($inventory);
    //     return $this->showOne($inventory);
    // }

}
