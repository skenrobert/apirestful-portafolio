<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use App\Models\CompanyType;
use Faker\Generator as Faker;


$factory->define(Company::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $company_types = CompanyType::orderBy('id', 'ASC')->pluck('id')->all(); 
    
    $array = [
         
        'email' => $faker->unique()->safeEmail,
        'nit'=> Str::random(10),
        'name' => $faker->name,
        'fundation'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'address'=>$faker->address,
        'description'=>$faker->address,
        'phone'=>$faker->phoneNumber,
        'website'=>$faker->domainName,
        'name_owner'=>$faker->name,
        'last_name_owner'=>$faker->name,
        'document_number'=>$faker->phoneNumber,
        'enrollment'=>$faker->unique()->randomNumber($nbDigits = 5),
        'Trade'=>$faker->unique()->randomNumber($nbDigits = 5),
        'companytype_id' => 2,    
      ];
    
    return $array;      
    
});

