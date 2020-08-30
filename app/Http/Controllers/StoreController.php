<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends ApiController
{
    public function index()
    {
       
        // $breadcrumbs = [
        //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Store"]
        // ];

        // $stores= Store::orderBy('id','DESC')->get();

        // $data = ['data'=>$stores, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $store = Store::create($request->all());
        return $this->showOne($store, 201);
        
    }

    public function show(Store $store)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Almacen"]
        ];

        $data = ['data'=>$store, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, Store $store)
    {
        $store->fill($request->all())->save();
        return $this->showOne($store);
    }

    public function destroy(Store $store)
    {
        $store->delete($store);
        return $this->showOne($store);
    }
}
