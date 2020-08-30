<?php


use App\Models\ClientHasPayment;
use App\Models\BillToCharge;
use App\Models\Person;

use Faker\Generator as Faker;


$factory->define(ClientHasPayment::class, function (Faker $faker) {
   
    $billtocharge = BillToCharge::orderBy('id', 'ASC')->pluck('id')->all(); 
    $people = Person::orderBy('id', 'ASC')->pluck('id')->all(); 

    $array = [
        'description'=>$faker->address,
        'transfer_code'=>$faker->unique()->randomNumber($nbDigits = 5),
        'payment_method'=> 'cash',
        'dues'=>$faker->randomNumber($nbDigits = 1),
        'paid'=>$faker->randomNumber($nbDigits = 5),

        'bill_to_charge_id'=>$faker->randomElement($billtocharge),
        'person_id'=>$faker->randomElement($people),

    ];
    
    return $array;      
    
});

