<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\TypeMovementInventory;
use App\Models\Item;
use Illuminate\Http\Request;

class CompanySalesController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
    public function index(Company $company)
    {
        $typemovementinventories = TypeMovementInventory::join('items', 'items.id', '=', 'type_movement_inventories.item_id')
        ->select('type_movement_inventories.unitpriceOut', 'type_movement_inventories.quantityOut','items.name','items.stock','items.stockAlert','items.code','items.id')
        ->where('type_movement_inventories.movement_type_id', '=', 3)
        ->where('items.company_id', '=', $company->id)
        ->get();
    
       $items = TypeMovementInventory::join('items', 'items.id', '=', 'type_movement_inventories.item_id')
       ->select('items.id')
       ->where('type_movement_inventories.movement_type_id', '=', 3)
       ->where('items.company_id', '=', $company->id)
       ->get();
    
       $items2 = Item::whereNotIn('id', $items)->get();
    
    
        $data = ['data'=>$typemovementinventories, 'data1'=>$items2];
        return $this->showAll($data);
    }

  
}
