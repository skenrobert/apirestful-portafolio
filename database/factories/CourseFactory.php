<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use App\Models\Shedule;

use Faker\Generator as Faker;


$factory->define(Course::class, function (Faker $faker) {
       
  $shedules = Shedule::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'name' => $faker->name,
      'description'=>$faker->address,
      'schedule_id' => $faker->randomElement($shedules),

      ];
    
    return $array;      
    
});

