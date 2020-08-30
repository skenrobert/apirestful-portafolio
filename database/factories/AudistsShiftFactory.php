<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AudistsShift;
use App\Models\ProductionDetailsConnec;
use App\Models\Employee;

use Faker\Generator as Faker;


$factory->define(AudistsShift::class, function (Faker $faker) {
   
    $employees = Employee::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $productiondetailsconnec = ProductionDetailsConnec::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
      'location'=>$faker->address,
      'bed'=> 1,
      'cleaning'=> 1,
      'tv'=> 1,
      'pc'=> 1,
      'cam'=> 1,
      'object'=> 1,
      'confirmed'=> 1,
      'production_details_connec_id' => $faker->randomElement($productiondetailsconnec),
      'monitordelivery_id' => $faker->randomElement($employees),
      'monitorreceives_id' => $faker->randomElement($employees),

    ];
    
    return $array;      
    
});
