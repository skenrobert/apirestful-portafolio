<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;

use Faker\Generator as Faker;


$factory->define(Contact::class, function (Faker $faker) {
       
    $array = [
        'name' => $faker->name,
        'last_name' => $faker->lastName, 
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,    

      ];
    
    return $array;      
    
});
