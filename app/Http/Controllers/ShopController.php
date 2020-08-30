<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ShopController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
   
    public function index()
    {
        // $shops= Shop::orderBy('id','DESC')->get();
        // $data = ['data'=>$shops];
        // return $this->showAll($data);
    }

    // public function store(Request $request)
    // {
    //     $shop = Shop::create($request->all());


    //     return $this->showOne($shop, 201);
    // }

    public function show(Shop $shop)
    {
        $data = ['data'=>$shop];
        return $this->showOne($data);
    }

    public function update(Request $request, Shop $shop)
    {
        $shop->fill($request->all())->save();
        return $this->showOne($shop);
    }

    // public function destroy(Shop $shop)
    // {
    //     $shop->delete($shop);
    //     return $this->showOne($shop);
    // }
}
