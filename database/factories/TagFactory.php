<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;

use Faker\Generator as Faker;


$factory->define(Tag::class, function (Faker $faker) {
   
    $array = [
        'name' => $faker->name,

    ];
    
    return $array;      
    
});
