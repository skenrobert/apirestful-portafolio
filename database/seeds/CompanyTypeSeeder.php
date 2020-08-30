<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyType;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        $name[1] = 'Estudio';
        $description[1] = 'Golden Premium Studio';
        $commission[1] = 0.9;

        $name[2] = 'Sub-Estudio';
        $description[2] = 'Sub-Estudio de Golden PS';
        $commission[2] = 0.8;
        
        for ($i=1;$i<=2; $i++){
            
            DB::table('company_types')->insert([

                'id' => $i,
                'name' => $name[$i],
                'description' => $description[$i],
                'commission' => $commission[$i],
                'created_at'=> now(),
                'updated_at'=> now()

            ]);

        }

    }//fin metodo
}
