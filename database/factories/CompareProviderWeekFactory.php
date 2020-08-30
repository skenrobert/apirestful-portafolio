<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CompareProviderWeek;
use App\Models\Provider;
use App\Models\Employee;
use App\Models\ProductionMaster;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(CompareProviderWeek::class, function (Faker $faker) {
   
  $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $employees = Employee::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  // $productiondetailsweek = ProductionDetailsWeek::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $productionmasters = ProductionMaster::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
        'total_provider_week'=>$faker->randomNumber($nbDigits = 8),
        'production_master_id' => $faker->randomElement($productionmasters),
        'provider_id' => $faker->randomElement($providers),
        'employee_id' => $faker->randomElement($employees),
        // 'production_details_week_id' => $faker->randomElement($productiondetailsweek),

    ];
    
    return $array;      
    
});
