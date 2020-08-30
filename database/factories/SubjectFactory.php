<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use App\Models\Course;

use Faker\Generator as Faker;


$factory->define(Subject::class, function (Faker $faker) {
       
  // $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  // $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $course = Course::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'name' => $faker->name,
      'description'=>$faker->address,
      'creditos'=>$faker->randomNumber($nbDigits = 7),
      'course_id' => $faker->randomElement($course),

      ];
    
    return $array;      
    
});
