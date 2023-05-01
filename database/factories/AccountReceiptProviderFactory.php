<?php

use App\Models\AccountReceiptProvider;
use App\Models\User;
use App\Models\Provider;
use App\Models\Event;

use Faker\Generator as Faker;


$factory->define(AccountReceiptProvider::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all();
    $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


    $array = [

        'name'=>$faker->name,
        'control_number'=>$faker->randomNumber($nbDigits = 3),
        'document_number'=>$faker->name,
        // 'date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'concept'=>$faker->address,
        'bank_number'=>$faker->address,
        'value'=>$faker->randomNumber($nbDigits = 3),
        'rte_fte'=>$faker->randomNumber($nbDigits = 2),
        'rete_ica'=>$faker->randomNumber($nbDigits = 2),
        'value_pay'=>$faker->randomNumber($nbDigits = 3),
        'value_pay_tex'=>$faker->name,
        'provider_id' => $faker->randomElement($providers),    
        'event_id' =>$faker->randomElement($events),
        'company_id' => 1,

      ];
    
    return $array;      
    
});



