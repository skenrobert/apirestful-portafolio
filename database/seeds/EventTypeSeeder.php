<?php

use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{

    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        // 1 = Alerta / 2 = Asignacion / 3 = Deduccion / 5 = Permiso
        $id[1] = 1;
        $name[1] = 'Alerta';
        $description[1] = 'Alerta de Atención';
        $value[1] = 0;
        $type[1] = 'Alerta';
        
        $id[2] = 2;
        $name[2] = 'Asignación';
        $description[2] = 'Asignación de pago remunerada';
        $value[2] = 10000;
        $type[2] = 'Asignación';

        $id[3] = 3;
        $name[3] = 'Deducción';
        $description[3] = 'Sansión por incumplimiento del reglamento interno';
        $value[3] = 100000;
        $type[3] = 'Deducción';    

        $id[4] = 4;
        $name[4] = 'Permiso';
        $description[4] = 'Permiso que exonera de otros eventos';
        $value[4] = 1;
        $type[4] = 'Permiso';

        $id[5] = 5;
        $name[5] = 'Cierre de Plannificación';
        $description[5] = 'cierra la plannificacion para proceder a sacar las comisiones';
        $value[5] = null;
        $type[5] = 'Cierre';

        $id[6] = 6;
        $name[6] = 'Calculo de Comisiones';
        $description[6] = 'Calcula las comisiones y cierra la producion y la planificacion pasa a ejecutada';
        $value[6] = null;
        $type[6] = 'Calculo';

        $id[7] = 7;
        $name[7] = 'Pago de Nomina';
        $description[7] = 'Calcula y Pago de la Nomina';
        $value[7] = null;
        $type[7] = 'Pago';

        $id[8] = 8;
        $name[8] = 'Pago Provedores de Servicios';
        $description[8] = 'Calcula y Pago a los Provedores de Servicio';
        $value[8] = null;
        $type[8] = 'Pago';

        $id[9] = 9;
        $name[9] = 'Ganancia de Estudios y Sub-Estudios';
        $description[9] = 'Calcula y Pago del Porcentace';
        $value[9] = null;
        $type[9] = 'Pago';

        $id[10] = 10;
        $name[10] = 'Ganancia de Satelite y PC-Satelite';
        $description[10] = 'Calcula y Pago del Porcentace';
        $value[10] = null;
        $type[10] = 'Pago';
        
        for ($i=1;$i<=10; $i++){
            
            DB::table('event_types')->insert([

                'id' => $i,
                'name' => $name[$i],
                'description' => $description[$i],
                'value'=> $value[$i],
                'type'=> $type[$i],
                'company_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }

    }//fin metodo
}
