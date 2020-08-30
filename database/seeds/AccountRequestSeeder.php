<?php

use Illuminate\Database\Seeder;
use App\Models\AccountRequest;

class AccountRequestSeeder extends Seeder
{
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        factory(App\Models\AccountRequest::class, 10)->create();

    }
}
