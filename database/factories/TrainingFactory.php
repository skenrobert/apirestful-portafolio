<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use App\Models\Record;
use App\Models\Training;

use Faker\Generator as Faker;


$factory->define(Training::class, function (Faker $faker) {
       
  // $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $records = Record::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $subjects = Subject::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'observation'=>$faker->address,
      'note'=>$faker->randomNumber($nbDigits = 7),
      'record_id' => $faker->randomElement($records),
      'subject_id' => $faker->randomElement($subjects),

      ];
    
    return $array;      
    
});

