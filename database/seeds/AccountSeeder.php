<?php

use Illuminate\Database\Seeder;
use App\Models\Site;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        factory(App\Models\Account::class, 100)->create();

    }//fin metodo
}
