<?php


use App\Models\Payroll;
use App\Models\Company;

use Faker\Generator as Faker;


$factory->define(Payroll::class, function (Faker $faker) {
   
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'Observation'=>$faker->address,
        'beginning'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'end'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'total'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'transport_aid'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'food_aid'=>$faker->unique()->randomNumber($nbDigits = 5),
        // 'additional_transport_assistance'=>$faker->unique()->randomNumber($nbDigits = 5),
        'number_control'=>$faker->unique()->randomNumber($nbDigits = 5),

        'company_id' => $faker->randomElement($companies),    

    ];
    
    return $array;      
    
});

