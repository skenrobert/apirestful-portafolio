<?php

use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id[1] = 1;
        $name[1] = 'Administrativo';
        $description[1] = 'Personal de Planta';
        $value[1] = 1;
        
        $id[2] = 2;
        $name[2] = 'Modelo Planta';
        $description[2] = 'Proveedor de Servicio  del Estudio';
        $value[2] = 0.6;

        $id[3] = 3;
        $name[3] = 'Modelo Satelite';
        $description[3] = 'Proveedor de Servicio a Distancia';
        $value[3] = 0.8;

        $id[4] = 4;
        $name[4] = 'Modelo PC';
        $description[4] = 'Proveedor de Servicio a Distancia con PC';
        $value[4] = 0.7;

        $id[5] = 5;
        $name[5] = 'Proveedor Servivios';
        $description[5] = 'Proveedor de Servicio, Contables o Contrastista';
        $value[5] = 1;

        $id[6] = 6;
        $name[6] = 'Proveedor Insumos';
        $description[6] = 'Proveedor de Servicio Insumos';
        $value[6] = 1;
        
        for ($i=1;$i<=6; $i++){
            
            DB::table('job_types')->insert([

                'id' => $i,
                'name' => $name[$i],
                'description' => $description[$i],
                'value'=> $value[$i],
                // 'company_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }
    }
}
