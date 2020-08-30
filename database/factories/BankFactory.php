<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bank;

use Faker\Generator as Faker;


$factory->define(Bank::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();
    
    $array = [
        'name' => $faker->lastName,
        'description' => $faker->address, 
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,    

      ];
    
    return $array;      
    
});
