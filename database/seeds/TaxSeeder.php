<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        $id[1] = 1;
        $name[1] = 'Impuesto 1';
        $value[1] = 0.05;
        
        $id[2] = 2;
        $name[2] = 'Impuesto 2';
        $value[2] = 0.05;

        $id[3] = 3;
        $name[3] = 'Impuesto 3';
        $value[3] = 0.05;

        $id[4] = 4;
        $name[4] = 'Impuesto 4';
        $value[4] = 0.05;

        for ($i=1;$i<=4; $i++){
            
            DB::table('taxes')->insert([

                'id' => $i,
                'name' => $name[$i],
                'value' => $value[$i],
            ]);

        }

    }//fin metodo
}
