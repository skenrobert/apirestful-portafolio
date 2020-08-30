<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        factory(App\Models\Company::class, 3)->create();

    }//fin metodo
}
