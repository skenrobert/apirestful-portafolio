<?php


use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Company;
// use App\Models\Event;
// use App\Models\Shop;

use Faker\Generator as Faker;


$factory->define(Payroll::class, function (Faker $faker) {
   
    $employee = Employee::orderBy('id', 'ASC')->pluck('id')->all(); 
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'Observation'=>$faker->address,
        'beginning'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'end'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'company_id' => $faker->randomElement($companies),    

        // 'total_paid'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'cost'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'quantity'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'total_cost'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'event_id'=>$faker->randomElement($events),
        // 'shop_id'=>$faker->randomElement($shops),
        // 'employee_id'=>$faker->randomElement($employee),

    ];
    
    return $array;      
    
});

