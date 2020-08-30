<?php

use Illuminate\Database\Seeder;
// use App\Models\Task;
use App\Models\Company;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()// 
    {

        $companies = Company::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena


        // Task::truncate();


        $name[1] = 'Inventario';
        $description[1] = 'Realizar Inventario de Artículos para la Venta';

        $name[2] = 'Aseo';
        $description[2] = 'Realizar el aseo de la oficina y sacar la basura de los botes';

        for ($i=1;$i<=2; $i++){
            
            DB::table('tasks')->insert([

                'id' => $i,
                'name' => $name[$i],
                'description' => $description[$i],
                'company_id' => shuffle($companies),


            ]);

        }

    }//fin metodo
}
