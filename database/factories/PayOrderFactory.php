<?php


use App\Models\PayOrder;
use App\Models\BillToPay;

use Faker\Generator as Faker;


$factory->define(PayOrder::class, function (Faker $faker) {
   
    $billtopays = BillToPay::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [

        'number'=>$faker->unique()->randomNumber($nbDigits = 5),
        'quantity'=>$faker->unique()->randomNumber($nbDigits = 5),
        'cost'=>$faker->unique()->randomNumber($nbDigits = 5),
        'description'=>$faker->address,
        'total'=>$faker->unique()->randomNumber($nbDigits = 5),
        'bill_to_pay_id'=>$faker->randomElement($billtopays),

    ];
    
    return $array;      
    
});

