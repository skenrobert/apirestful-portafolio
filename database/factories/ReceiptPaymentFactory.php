<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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
        'observation' => $faker->name,
        'pay_salary' => $faker->randomElement($array = array (50000, 100000)),
        'payroll_id' => $faker->randomElement($payroll),
        'event_id' => $faker->randomElement($events),    
        'paycommission' => $faker->randomElement($array = array (50000, 100000)),
        'user_id' => $faker->randomElement($users),    
        'number_receipt' =>$faker->randomNumber($nbDigits = 3),

        'ret_fte' => $faker->randomElement($array = array (5000, 10000)),
        'value_collect' => $faker->randomElement($array = array (5000, 10000)),
        'value_pay' => $faker->randomElement($array = array (5000, 10000)),

    ];
    
    return $array;      
    
});
