<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\Company;
use App\Models\AccountPlan;
// use App\Models\Employee;
// use App\Models\EventType;

use Faker\Generator as Faker;


$factory->define(Item::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 
    $accountplan = AccountPlan::orderBy('id', 'ASC')->pluck('id')->all(); 
    // $provider = Provider::orderBy('id', 'ASC')->pluck('id')->all();
    // $employees = Employee::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'name' => $faker->name,
        'code'=>$faker->unique()->randomNumber($nbDigits = 8),
        'description'=>$faker->address,
        'unity' => $faker->randomElement($array = array (1, 6, 12)),
        'sale_price'=>$faker->unique()->randomNumber($nbDigits = 5),
        'stock'=>$faker->randomNumber($nbDigits = 5),
        'stockAlert'=>$faker->randomNumber($nbDigits = 5),
        'Company_id'=>$faker->randomElement($companies),
        // 'account_plan_id'=>$faker->randomElement($accountplan),

    ];
    
    return $array;      
    
});
