<?php

use App\Models\ReceiptPayment;
use App\Models\Payroll;
use App\Models\Event;
use App\Models\User;

use Faker\Generator as Faker;


$factory->define(ReceiptPayment::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $payroll = Payroll::orderBy('id', 'ASC')->pluck('id')->all(); 
    $events = Event::orderBy('id', 'ASC')->pluck('id')->all(); 
    $users = User::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'name' => $faker->name,
        'document_number'=>$faker->unique()->randomNumber($nbDigits = 8),
        'worked_days'=>$faker->unique()->randomNumber($nbDigits = 2),
        'pay_salary' => $faker->randomElement($array = array (100, 100)),
        'pay_transport_aid' => $faker->randomElement($array = array (100, 100)),
        'pay_additional_transport' => $faker->randomElement($array = array (100, 100)),
        'pay_food_aid' => $faker->randomElement($array = array (100, 100)),
        'health' => $faker->randomElement($array = array (35, 35)),
        'pension' => $faker->randomElement($array = array (35, 35)),
        'total_income' => $faker->randomElement($array = array (10000, 1000000)),
        'total_discounts' => $faker->randomElement($array = array (10000, 1000000)),
        'total_pay' => $faker->randomElement($array = array (10000, 1000000)),
        'number_receipt'=>$faker->unique()->randomNumber($nbDigits = 2),

        'payroll_id' => $faker->randomElement($payroll),
        'event_id' => $faker->randomElement($events),  
        'user_id' => $faker->randomElement($users),    

    ];
    
    return $array;      
    
});
