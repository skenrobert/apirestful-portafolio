<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComissionEmployeeSeeder extends Seeder
{
    public function run()
    {

        factory(App\Models\ComissionEmployee::class, 20)->create();

    }
}
