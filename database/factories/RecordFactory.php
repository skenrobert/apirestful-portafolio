<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Company;
use App\Models\Course;
use App\Models\Record;

use Faker\Generator as Faker;


$factory->define(Record::class, function (Faker $faker) {
       
  $users = User::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $course = Course::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
        'user_id' => $faker->randomElement($users),
        'company_id' => $faker->randomElement($companies),
        'course_id' => $faker->randomElement($course),

      ];
    
    return $array;      
    
});

