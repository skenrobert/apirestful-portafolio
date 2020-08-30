<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Eps;

use Faker\Generator as Faker;


$factory->define(Eps::class, function (Faker $faker) {
   
    //DB::table('epss')->truncate();
    
    $array = [
        'name' => $faker->name,
        'slug' => $faker->lastName,
    ];
    
    return $array;      
    
});
