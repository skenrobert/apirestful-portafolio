<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Commission;
use App\Models\Company;
use App\Models\ShiftHasPlanning;

use App\Models\ProductionMaster;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(ProductionMaster::class, function (Faker $faker) {
   
  $commission = Commission::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $shifthasplanning = ShiftHasPlanning::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
      
      // 'name' => $faker->name,
      'tkn_total_week'=>$faker->randomNumber($nbDigits = 7),
      // 'beginning_week'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      // 'end_week'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'observation_week'=>$faker->address,
      'dolar_total_week'=>$faker->randomNumber($nbDigits = 8),
      'dolar_total_assigned'=>$faker->randomNumber($nbDigits = 4),
      // 'tkn_week_default'=>$faker->randomNumber($nbDigits = 7),
      'value_trm'=>$faker->randomNumber($nbDigits = 3),
      'minimum_limit'=>$faker->randomNumber($nbDigits = 7),
      'commission_employed_payment'=>$faker->randomNumber($nbDigits = 2),
      'estimated'=>$faker->randomNumber($nbDigits = 8),
      'commission_id' => $faker->randomElement($commission),
      'company_id' => $faker->randomElement($companies),
      'shift_has_planning_id' => $faker->randomElement($shifthasplanning),

      

    ];
    
    return $array;      
    
});
