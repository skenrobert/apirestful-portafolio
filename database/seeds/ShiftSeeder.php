<?php

use Illuminate\Database\Seeder;

use App\Models\Company;

class ShiftSeeder extends Seeder
{

    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {
        // $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


        $id[1] = 1;
        $name[1] = 'Mañana';
        // $start[1] = date("H:i:s");
        $start[1] = '7:00:00';
        $end[1] = '13:45:00';
        $break[1] = '10';
        
        $id[2] = 2;
        $name[2] = 'Tarde';
        $start[2] = '14:15:00';
        $end[2] = '20:45:00';
        $break[2] = '10';

        $id[3] = 3;
        $name[3] = 'Noche';
        $start[3] = '21:30:00';
        $end[3] = '5:45:00';
        $break[3] = '20';

        for ($i=1;$i<=3; $i++){
            
            DB::table('shifts')->insert([

                'id' => $i,
                'name' => $name[$i],
                'start' => $start[$i],
                'end'=> $end[$i],
                'break'=> $break[$i],
                // 'company_id' => shuffle($companies),


            ]);
        }

    }//fin metodo
}
