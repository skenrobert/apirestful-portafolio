<?php

use App\Models\SaleInvoice;
use App\Models\BillToCharge;

use Faker\Generator as Faker;


$factory->define(SaleInvoice::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $billtocharges = BillToCharge::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'number'=>$faker->unique()->randomNumber($nbDigits = 8),
        'sub_total'=>$faker->unique()->randomNumber($nbDigits = 3),
        'description_null'=>$faker->address,
        'total'=>$faker->unique()->randomNumber($nbDigits = 3),
        'bill_to_charge_id'=>$faker->randomElement($billtocharges),
    ];
    
    return $array;      
    
});
