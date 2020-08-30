<?php


use App\Models\BillToPay;
use App\Models\Accounting;
use App\Models\Event;
use App\Models\User;

use Faker\Generator as Faker;


$factory->define(BillToPay::class, function (Faker $faker) {
   
    $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); 
    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); 
    $accountings = Accounting::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'description'=>$faker->address,
        'way_to_pay'=>'cash',
        'transfer_code'=>$faker->unique()->randomNumber($nbDigits = 5),
        'quantity'=>$faker->unique()->randomNumber($nbDigits = 5),
        'total_cost'=>$faker->unique()->randomNumber($nbDigits = 5),
        'total_paid'=>$faker->unique()->randomNumber($nbDigits = 5),

        'owner_id'=>$faker->randomElement($users),
        'event_id'=>$faker->randomElement($events),
        'accounting_id'=>$faker->randomElement($accountings),

    ];
    
    return $array;      
    
});
