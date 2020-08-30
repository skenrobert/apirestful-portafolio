<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;

use Faker\Generator as Faker;


$factory->define(Category::class, function (Faker $faker) {
   
    // $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'name' => $faker->name,
        'description'=>$faker->address,
        // 'company_id'=>$faker->randomElement($companies),

    ];
    
    return $array;      
    
});


