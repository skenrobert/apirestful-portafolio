<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionMaster;
use App\Models\ProductionDetailsDay;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(ProductionDetailsDay::class, function (Faker $faker) {
   
  // $productiondetailsweek = ProductionDetailsWeek::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $productionmasters = ProductionMaster::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
        'observation_day'=>$faker->address,
        'dolar_total_day'=>$faker->randomNumber($nbDigits = 5),
        'day_week'=>$faker->randomElement($array = array (1,2,3,4,5,6,7)), // 1 = Lunes | 2 = Martes | 3 = Miercoles | 4 = Jueves | 5 = viernes | 6 = sabado |7 = domingo
        // 'production_details_week_id' => $faker->randomElement($productiondetailsweek),
        'production_master_id' => $faker->randomElement($productionmasters),


    ];
    
    return $array;      
    
});
