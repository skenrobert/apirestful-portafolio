<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AuditShift;
use App\Models\ProductionDetailsConnec;
use App\Models\User;

use Faker\Generator as Faker;


$factory->define(AuditShift::class, function (Faker $faker) {
   
    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
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
      'monitordelivery_id' => $faker->randomElement($users),
      'monitorreceives_id' => $faker->randomElement($users),

    ];
    
    return $array;      
    
});
