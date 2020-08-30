<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class AccountPlanSeeder extends Seeder
{
    public function run()
    {
         
         $name[1] = 'Activo';
         $code[1] = 1;
         $description[1] = 'Descripción Cuenta Activo';
        
         $name[2] = 'Pasivo';
         $code[2] = 2;
         $description[2] = 'Descripción Cuenta Pasivo';
        
         $name[3] = 'Patrimonio';
         $code[3] = 3;
         $description[3] = 'Descripción Cuenta Patrimonio';
  
         $name[4] = 'Ingresos';
         $code[4] = 4;
         $description[4] = 'Descripción Cuenta de Ingresos';
  
         $name[5] = 'Gastos';
         $code[5] = 5;
         $description[5] = 'Descripción Cuenta de Gastos';

         $name[6] = 'Costos de Venta';
         $code[6] = 6;
         $description[6] = 'Descripción Cuenta Costos de Venta';
  
         $name[7] = 'Costos de Producción u Operación';
         $code[7] = 7;
         $description[7] = 'Descripción Cuenta Costos de Producción u Operación';
  
         $name[8] = 'Cuentas de Orden Deudoras';
         $code[8] = 8;
         $description[8] = 'Descripción Cuentas de Orden Deudoras';
  
         $name[9] = 'Cuentas de Orden Acreedoras';
         $code[9] = 9;
         $description[9] = 'Descripción Cuentas de Orden Acreedoras';
  

             
        for ($i=1; $i < 10; $i++) { 

            DB::table('account_plan')->insert([
 
                'name' => $name[$i],
                'code' => $code[$i],
                'description' => $description[$i],
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }
        //  }
        
    }
}
