<?php

use App\Models\ComissionStudy;
use App\Models\Event;
use App\Models\Company;

use Faker\Generator as Faker;


$factory->define(ComissionStudy::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); 
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'observation' => $faker->address,
        'paycommission'=>$faker->unique()->randomNumber($nbDigits = 8),
        'production' => $faker->randomElement($array = array (10000, 1000000)),
        'commission'=>$faker->unique()->randomNumber($nbDigits = 8),

        // 'payroll_id' => $faker->randomElement($payroll),
        'event_id' => $faker->randomElement($events),  
        'company_id' => $faker->randomElement($companies),    

    ];
    
    return $array;      
    
});
