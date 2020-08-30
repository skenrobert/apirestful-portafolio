<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shedule;

use Faker\Generator as Faker;


$factory->define(Shedule::class, function (Faker $faker) {
       
  // $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  // $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  // $course = Course::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'beginning'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'end'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'hour_beginning'=> '20:00',
      'hour_end'=> '20:00',
      'observation'=>$faker->address,

      ];
    
    return $array;      
    
});
