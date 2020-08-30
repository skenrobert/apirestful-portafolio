<?php

use App\Models\Shop;
use App\Models\Company;

use Faker\Generator as Faker;


$factory->define(Shop::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'name'=>$faker->name,
        'description'=>$faker->address,
        'phone'=>$faker->unique()->randomNumber($nbDigits = 8),
        'address'=>$faker->address,
        'company_id'=>$faker->randomElement($companies),
    ];
    
    return $array;      
    
});
