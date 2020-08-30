<?php


use App\Models\Accounting;
use App\Models\Company;
use App\Models\Inventory;
use App\Models\Payroll;

use Faker\Generator as Faker;


$factory->define(Accounting::class, function (Faker $faker) {
   
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 
    $inventories = Inventory::orderBy('id', 'ASC')->pluck('id')->all(); 
    $payroll = Payroll::orderBy('id', 'ASC')->pluck('id')->all(); 
    
    $array = [
        'name' => $faker->name,
        'description'=>$faker->address,
        'slug' => $faker->lastName,

        'Company_id'=>$faker->randomElement($companies),
        // 'inventory_id'=>$faker->randomElement($inventories),
        // 'payroll_id'=>$faker->randomElement($payroll),

    ];
    
    return $array;      
    
});

