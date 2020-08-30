<?php


use App\Models\BillToCharge;
use App\Models\Accounting;
use App\Models\Event;
use App\Models\Shop;

use Faker\Generator as Faker;


$factory->define(BillToCharge::class, function (Faker $faker) {
   
    // $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); 
    $shops = Shop::orderBy('id', 'ASC')->pluck('id')->all(); 
    $accountings = Accounting::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'description'=>$faker->address,
        'total_paid'=>$faker->unique()->randomNumber($nbDigits = 5),
        'quantity'=>$faker->unique()->randomNumber($nbDigits = 5),
        'total_cost'=>$faker->unique()->randomNumber($nbDigits = 5),

        // 'event_id'=>$faker->randomElement($events),
        'shop_id'=>$faker->randomElement($shops),
        'accounting_id'=>$faker->randomElement($accountings),

    ];
    
    return $array;      
    
});
