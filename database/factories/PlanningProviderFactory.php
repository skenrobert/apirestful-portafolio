<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlanningProvider;
// use App\Models\Provider;
use App\Models\User;
use App\Models\Room;
use App\Models\MonitorShift;
// use App\Models\Shift;

use Faker\Generator as Faker;


$factory->define(PlanningProvider::class, function (Faker $faker) {
   
    //DB::table('epss')->truncate();
    // $providers = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $rooms = Room::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $monitorshift = MonitorShift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    // $shifts = Shift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


    
    $array = [
       
      // 'status'=>$faker->randomElement($array = array ('planing','present','past')),
      'observation'=>$faker->address,
      'used'=> 1,
      'monitor_shift_id' => $faker->randomElement($monitorshift),
      'room_id' => $faker->randomElement($rooms),
      'model_id' => $faker->randomElement($users),
      'goal_dollar'=>$faker->randomNumber($nbDigits = 3),
      'goal_tkn'=>$faker->randomNumber($nbDigits = 4),
      'production_total_dollar'=>$faker->randomNumber($nbDigits = 4),

    ];
    
    return $array;      
    
});
