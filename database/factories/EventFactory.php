<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\Site;
use App\Models\Company;
use App\Models\User;
use App\Models\EventType;
use App\Models\ProductionMaster;
use App\Models\Audiovisual;

use Faker\Generator as Faker;


$factory->define(Event::class, function (Faker $faker) {
   
    //DB::table('accounts')->truncate();

    $sites = Site::orderBy('id', 'ASC')->pluck('id')->all(); 
    $event_types = EventType::orderBy('id', 'ASC')->pluck('id')->all(); 
    $users = User::orderBy('id', 'ASC')->pluck('id')->all();
    $productionmaster = ProductionMaster::orderBy('id', 'ASC')->pluck('id')->all();
    $audiovisual = Audiovisual::orderBy('id', 'ASC')->pluck('id')->all();
    $companies = Company::orderBy('id', 'ASC')->pluck('id')->all();

    $array = [
        'title' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'observation' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'processed' => $faker->randomElement($array = array (0, 1)),
        'value_real' => $faker->randomElement($array = array (100, 10000)),
        'event_type_id' => 1,
        'user_id' => $faker->randomElement($users),    
        'model_id' => $faker->randomElement($users),    
        'create_event_id' => $faker->randomElement($users),    
        'audiovisual_id' => $faker->randomElement($audiovisual),    
        'production_master_id' => $faker->randomElement($productionmaster),    
        'company_id' => $faker->randomElement($companies),    
        'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')    
    ];
    
    return $array;      
    
});
