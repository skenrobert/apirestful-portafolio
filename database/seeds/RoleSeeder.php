<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        
        $name[1]= 'Modelo';
        $slug[1]= 'model';
        $description[1]= 'Rol de Modelo';

        $name[2]= 'Monitor';
        $slug[2]= 'monitor';
        $description[2]= 'Rol de Monitor';
        
        $name[3]= 'Supervisor';
        $slug[3]= 'manager';
        $description[3]= 'Rol de Supervisor';

        $name[4]= 'Administrador';
        $slug[4]= 'admin';
        $description[4]= 'Rol de Admininstrador';     
 
        $name[5]= 'Cuentas';
        $slug[5]= 'accounts';
        $description[5]= 'Rol de Cuentas';

        $name[6]= 'Contabilidad';
        $slug[6]= 'contab';
        $description[6]= 'Rol de Contabilidad';

        $name[7]= 'Audiovisuales';
        $slug[7]= 'photos';
        $description[7]= 'Rol de Audiovisuales';

        $name[8]= 'Sub-Estudio';
        $slug[8]= 'sub-study';
        $description[8]= 'Rol de Sub-Estudio';
        
        $name[9]= 'Estudio';
        $slug[9]= 'study';
        $description[9]= 'Rol de Estudio';     
 
        for ($i=1;$i<=9; $i++){
        
            DB::table('roles')->insert([

            'id' => $i,
            'name' => $name[$i],
            'slug' => $slug[$i],
            'description'=> $description[$i],

          ]);
        }

    }//fin metodo
}
