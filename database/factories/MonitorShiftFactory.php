<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MonitorShift;
use App\Models\Task;
use App\Models\User;
use App\Models\ShiftHasPlanning;
use App\Models\Shift;


use Faker\Generator as Faker;


$factory->define(MonitorShift::class, function (Faker $faker) {
   
    //DB::table('epss')->truncate();
    $tasks = Task::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $shifthasplanning = ShiftHasPlanning::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $shifts = Shift::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    
    $array = [
       
      // 'status'=>$faker->randomElement($array = array ('planing','present','past')),
      'observation'=>$faker->address,
      // 'used'=> 1,
      'task_id' => $faker->randomElement($tasks),
      'monitor_id' => $faker->randomElement($users),
      'shift_has_planning_id' => $faker->randomElement($shifthasplanning),
      'shift_id' => $faker->randomElement($shifts),
      'goal_dollar_monitor'=>$faker->randomNumber($nbDigits = 3),
      'goal_tkn_monitor'=>$faker->randomNumber($nbDigits = 4),


    ];
    
    return $array;      
    
});
