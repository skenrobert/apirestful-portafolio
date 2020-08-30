<?php


use App\Models\Store;
use App\Models\Company;

use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
   
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'name' => $faker->name,
        'phone'=>$faker->unique()->randomNumber($nbDigits = 8),
        'description'=>$faker->address,
        'address'=>$faker->address,
        'company_id' => $faker->randomElement($companies),

    ];
    
    return $array;      
    
});
