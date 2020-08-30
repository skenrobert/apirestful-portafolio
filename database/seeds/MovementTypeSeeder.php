<?php

use Illuminate\Database\Seeder;

class MovementTypeSeeder extends Seeder
{
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        $id[1] = 1;
        $name[1] = 'Saldo Inicial';
        $description[1] = 'Cantidad con se Inicializa los Articulos';

        $id[2] = 2;
        $name[2] = 'Compra';
        $description[2] = 'Asignación de Articulos Recien Comprado';

        $id[3] = 3;
        $name[3] = 'Venta';
        $description[3] = 'Deducción de Articulos Recien Vendido';

        $id[4] = 4;
        $name[4] = 'Devolución de Cliente';
        $description[4] = 'Reintegro de Articulo al Inventario y Devolucion del Dinero';

        $id[5] = 5;
        $name[5] = 'Devolución de Proveedor';
        $description[5] = 'Reintegro de Articulo al Proveedor';

        $id[6] = 6;
        $name[6] = 'Retiro Otro Concepto';
        $description[6] = 'Retiro de Articulo por Deterioro';

        $id[7] = 7;
        $name[7] = 'Traslado de Almacen';
        $description[7] = 'Movimiento de Articulo de un Almacen a Otro';

        for ($i=1;$i<=7; $i++){
            
            DB::table('movement_type')->insert([

                'id' => $i,
                'name' => $name[$i],
                'description' => $description[$i],
                // 'value'=> $value[$i],
                // 'type'=> $type[$i],
                // 'company_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }

    }//fin metodo
}
