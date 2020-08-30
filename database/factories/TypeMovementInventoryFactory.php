<?php


use App\Models\TypeMovementInventory;
use App\Models\MovementType;
use App\Models\Store;
use App\Models\Inventory;
use App\Models\BillToCharge;
use App\Models\Item;

use Faker\Generator as Faker;


$factory->define(TypeMovementInventory::class, function (Faker $faker) {
   
    $movementtype = MovementType::orderBy('id', 'ASC')->pluck('id')->all(); 
    $stores = Store::orderBy('id', 'ASC')->pluck('id')->all(); 
    $inventories = Inventory::orderBy('id', 'ASC')->pluck('id')->all(); 
    $billtocharges = BillToCharge::orderBy('id', 'ASC')->pluck('id')->all(); 
    $items = Item::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [

        'description'=>$faker->address,
        'quantityIn'=>$faker->randomNumber($nbDigits = 5),
        'totalIn'=>$faker->randomNumber($nbDigits = 5),
        'unitpriceIn'=>$faker->randomNumber($nbDigits = 5),
        'unitpriceOut'=>$faker->randomNumber($nbDigits = 5),
        'totalOut'=>$faker->randomNumber($nbDigits = 5),
        'quantityOut'=>$faker->randomNumber($nbDigits = 5),
        'movement_type_id'=>$faker->randomElement($movementtype),
        'store_id'=>$faker->randomElement($stores),
        'inventory_id'=>1,//agragarle ese inventario a una empresa
        'bill_to_charge_id'=>$faker->randomElement($billtocharges),
        'item_id'=>$faker->randomElement($items),

    ];
    
    return $array;      
    
});
