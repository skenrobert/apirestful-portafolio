<?php

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\JobType;
use App\Models\Provider;
// use App\Models\Client;
use App\Models\Room;
use App\Models\Locker;
use App\Models\Boutique;
use App\Models\Company;
use App\Models\Image;
use App\Models\ShiftHasPlanning;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
//use Faker\Generator as Faker;
use Faker\Generator;


//use Faker\Provider\ro_RO\Person; // prueba no sirve
//namespace Faker\Provider\es_VE\Person;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/* @var \Illuminate\Database\Eloquent\Factory $factory */


$factory->define(Person::class, function (Generator $faker) {
    //static $password;

    $array = [
      'document_number'=>$faker->unique()->randomNumber($nbDigits = 8),
      'document_type'=>$faker->randomElement($array = array (0,1)), // 0 = Cédula | 1 = Pasaporte
      'rut'=> 1,
      'sigin'=> 1,
      'nationality'=>$faker->countryCode,
      'name'=>$faker->name,
      'last_name'=>$faker->lastName,
      'birthdate'=>$faker->date($format = 'Y-m-d', $max = 'now'),
      'gender'=>$faker->randomElement($array = array ('Mujer','Pareja','Hombre','Trans')), 
      'address'=>$faker->address,
      'phone'=>$faker->phoneNumber,
      'mobile_phone'=>$faker->phoneNumber,
      'nationality'=>$faker->randomElement($array = array (0,1)), // 0 = Colombiana | 1 = Extranjero
      'bank_account'=>$faker->uuid,
      // 'epss_id'=>1,
      'banks_id'=>1,
      'slug'=>'name',

    ];

    return $array;

});

$factory->define(User::class, function (Generator $faker) {
  static $password;

  $people = Person::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

  $array = [
    'person_id' =>$faker->randomElement($people),
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => now(),
    'password' => $password ?: $password = bcrypt('secret'), 
    'remember_token' => Str::random(10),
    'slug'=>'email',
    'status' => $faker->randomElement($array = array (0,1)),
    'company_id' =>$faker->randomElement($companies),

  ];

  $info = array_get($array, 'company_id');

  $companies = Company::find($info);
  $companies->people()->sync($people);

  return $array;

});

$factory->define(Employee::class, function (Generator $faker) {

  $people = Person::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  $jobtype = JobType::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'person_id' =>$faker->randomElement($people),// genera un random perminitiendo crear la relacion entre people y empleados
      'jobtype_id' => 1,// genera un random perminitiendo crear la relacion entre people y empleados
      'init'=>$faker->date($format = 'Y-m-d', $max = 'now'),


    ];

    return $array;

});

// $factory->define(Client::class, function (Generator $faker) {

//   $people = Person::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

//     $array = [
//       'person_id' =>$faker->randomElement($people),// genera un random perminitiendo crear la relacion entre people y clientes
      
//     ];

//     return $array;

// });


$factory->define(Provider::class, function (Generator $faker) {

  $people = Person::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
      'person_id' =>$faker->randomElement($people),// genera un random perminitiendo crear la relacion entre people y proveedores
      'jobtype_id'=>$faker->randomElement($array = array (2,3,4,5,6)),//2.3.4.5,6
      'init'=>$faker->date($format = 'Y-m-d', $max = 'now'),
    ];

    return $array;

});


$factory->define(Locker::class, function (Generator $faker) {

  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

  $array = [

  
    'number'=>$faker->unique()->randomNumber($nbDigits = 8),
    'location'=>$faker->address,
    'status'=>$faker->randomElement($array = array (0, 1, 2)),
    'company_id' =>$faker->randomElement($companies),

  ];

  return $array;

});



$factory->define(Room::class, function (Generator $faker) {

  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
  // $shifthasplanning = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

  $array = [
    'name'=>$faker->name,
    'address'=>$faker->address,
    'description'=>$faker->address,
    'status'=>$faker->randomElement($array = array (0, 1, 2)),
    'company_id' =>$faker->randomElement($companies),
    // 'shift_has_planning_id' =>$faker->randomElement($shifthasplanning),


  ];

  return $array;

});


$factory->define(Boutique::class, function (Generator $faker) {

  $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

  $array = [

  
    'price'=>$faker->unique()->randomNumber($nbDigits = 3),
    'name'=>$faker->name,
    'description'=>$faker->address,
    'code'=>$faker->unique()->randomNumber($nbDigits = 4),
    'company_id' =>$faker->randomElement($companies),

  ];

  return $array;

});



