<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EventSeeder extends Seeder
{

    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        factory(App\Models\Event::class, 20)->create();

    }//fin metodo
}
