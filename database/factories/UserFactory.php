<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    static $password;
   
    return [

        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'password' => $password ?: $password = bcrypt('secret'), // password
        'remember_token' => Str::random(10),
        'status' => $faker->randomElement($array = array (0,1)),
        'type'=>$faker->randomElement($array = array ('master','study', 'sub-study', 'admin', 'manager', 'accounts', 'monitor', 'model', 'design', 'photos', 'shop')),

    ];
});
