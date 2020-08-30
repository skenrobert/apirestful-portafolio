<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use App\Models\Site;
use App\Models\Provider;
use App\Models\Company;
use App\Models\User;


use Faker\Generator as Faker;


$factory->define(Account::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); 
    $sites = Site::orderBy('id', 'ASC')->pluck('id')->all(); 
    // $provider = Provider::orderBy('id', 'ASC')->pluck('id')->all();
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


    $array = [
        'nickname' => $faker->name,
        'description' => Str::random(10),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        'site_id' => $faker->randomElement($sites),
        'user_create_id' => $faker->randomElement($users),    
        'user_id' => $faker->randomElement($users),    
        'create_date' =>$faker->date($format = 'Y-m-d', $max = 'now'),  
        'email' => $faker->unique()->safeEmail,
        'status'=>$faker->randomElement($array = array (0, 1)),
        'company_id' =>$faker->randomElement($companies),



      ];
    
    return $array;      
    
});
