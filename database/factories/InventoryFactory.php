<?php


use App\Models\Inventory;
// use App\Models\Company;
use App\Models\Shop;

use Faker\Generator as Faker;


$factory->define(Inventory::class, function (Faker $faker) {
   
    $shops = Shop::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'description'=>$faker->address,
        'shop_id'=>$faker->randomElement($shops),

    ];
    
    return $array;      
    
});
