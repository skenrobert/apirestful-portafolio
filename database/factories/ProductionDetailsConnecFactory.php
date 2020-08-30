<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionDetailsConnec;
use App\Models\ProductionDetailsShift;
use App\Models\Provider;
use App\Models\User;

use Faker\Generator as Faker;

// use faker.providers.date_time;


$factory->define(ProductionDetailsConnec::class, function (Faker $faker) {
   
  
  $productiondetailsshift = ProductionDetailsShift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
        'observation_int'=>$faker->address,
        'observation_end'=>$faker->address,
        'dolar_total_provider'=>$faker->randomNumber($nbDigits = 3),
        'tkn_total_provider'=>$faker->randomNumber($nbDigits = 3),
        'connection_start'=>'17:17:18',
        'connection_end'=>'17:17:18',
        'break_start'=>'17:17:18',
        'break_end'=>'17:17:18',
        'production_details_shift_id' => $faker->randomElement($productiondetailsshift),
        'user_id' => $faker->randomElement($users),

    ];
    
    return $array;      
    
});
