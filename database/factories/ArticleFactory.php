<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\Company;
use App\Models\Category;

use Faker\Generator as Faker;


$factory->define(Article::class, function (Faker $faker) {
   
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 
    $categories = Category::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'title' => $faker->name,
        'text'=>$faker->address,
        'category_id'=>$faker->randomElement($categories),
        'company_id'=>$faker->randomElement($companies),

    ];
    
    return $array;      
    
});
