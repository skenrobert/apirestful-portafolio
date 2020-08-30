<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionDetailsWeek;
use App\Models\ShiftHasPlanning;
use App\Models\Shift;
use App\Models\Company;

use Faker\Generator as Faker;


$factory->define(ShiftHasPlanning::class, function (Faker $faker) {
   
    //DB::table('epss')->truncate();
    // $productiondetailsweeks = ProductionDetailsWeek::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    // $shifts = Shift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
      'confirmed'=> 1,
      'status'=>$faker->randomElement($array = array('Planeacion','Ejecucion','Ejecutada')),
      'observation'=>$faker->address,
      // 'goal_week'=>$faker->unique()->randomNumber($nbDigits = 6),
      'beginning_week'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'end_week'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'company_id' => $faker->randomElement($companies),

      // 'production_details_week_id' => $faker->randomElement($productiondetailsweeks),

    ];
    
    return $array;      
    
});
