<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Audiovisual;
use App\Models\Company;
use App\Models\Provider;
use App\Models\Employee;

use Faker\Generator as Faker;


$factory->define(Audiovisual::class, function (Faker $faker) {
   
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); 
    $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all();
    $employees = Employee::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'name' => $faker->name,
        'description'=>$faker->address,
        'category' => $faker->name,
        'time'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_id'=>$faker->randomElement($employees),
        'provider_id'=>$faker->randomElement($providers),
        'company_id'=>$faker->randomElement($companies),

    ];
    
    return $array;      
    
});
