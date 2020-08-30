<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionDetailsWeek;
use App\Models\ProductionMaster;
use App\Models\ShiftHasPlanning;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(ProductionDetailsWeek::class, function (Faker $faker) {
   
  $productionmasters = ProductionMaster::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $shifthasplanning = ShiftHasPlanning::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
        'observation_week'=>$faker->address,
        'dolar_total_week'=>$faker->randomNumber($nbDigits = 8),
        'production_master_id' => $faker->randomElement($productionmasters),
        'shifthasplanning_id' => $faker->randomElement($shifthasplanning),

    ];
    
    return $array;      
    
});
