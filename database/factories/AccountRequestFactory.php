<?php

use App\Models\AccountRequest;
use App\Models\User;
use App\Models\Provider;
use App\Models\Company;

use Faker\Generator as Faker;


$factory->define(AccountRequest::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); 
    $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all();
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


    $array = [
        'nickname'=>$faker->name,
        'provider_id' => $faker->randomElement($providers),    
        'company_id' =>$faker->randomElement($companies),
        'user_request_id' =>$faker->randomElement($users),

      ];
    
    return $array;      
    
});


// 'name',
