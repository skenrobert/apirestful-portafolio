<?php

use App\Models\ComissionModel;
use App\Models\Event;
use App\Models\User;

use Faker\Generator as Faker;


$factory->define(ComissionModel::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); 
    $users = User::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'observation' => $faker->address,
        'paycommission'=>$faker->unique()->randomNumber($nbDigits = 8),
        'production' => $faker->randomElement($array = array (10000, 1000000)),
        'commission'=>$faker->unique()->randomNumber($nbDigits = 8),

        // 'payroll_id' => $faker->randomElement($payroll),
        'event_id' => $faker->randomElement($events),  
        'user_id' => $faker->randomElement($users),    

    ];
    
    return $array;      
    
});
