<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionDetailsShift;
// use App\Models\Shift;
use App\Models\ProductionDetailsDay;
use App\Models\Employee;
use App\Models\MonitorShift;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(ProductionDetailsShift::class, function (Faker $faker) {
   
  // $shifts = Shift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $productiondetailsdays = ProductionDetailsDay::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $monitorshifts = MonitorShift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
        'observation_shift'=>$faker->address,
        'dolar_total_monitor_shift'=>$faker->randomNumber($nbDigits = 8),
        'tkn_total_monitor'=>$faker->randomNumber($nbDigits = 8),
        // 'productionmaster_id' => $faker->randomElement($productiondetailsdays),
        'production_details_day_id' => $faker->randomElement($productiondetailsdays),
        // 'shift_id' => $faker->randomElement($shifts),
        'monitor_shift_id' => $faker->randomElement($monitorshifts),

    ];
    
    return $array;      
    
});
