<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AccountProductionDetails;
use App\Models\Account;
use App\Models\ProductionDetailsConnec;

use Faker\Generator as Faker;

$factory->define(AccountProductionDetails::class, function (Faker $faker) {

    $productiondetailsconnec = ProductionDetailsConnec::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena
    $accounts = Account::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

    $array = [
        
        'dolar'=>$faker->randomNumber($nbDigits = 3),
        'tkn'=>$faker->randomNumber($nbDigits = 3),
        'production_details_connec_id' => $faker->randomElement($productiondetailsconnec),
        'account_id' => $faker->randomElement($accounts),

    ];

    return $array;      

});
