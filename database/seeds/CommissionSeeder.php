<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class CommissionSeeder extends Seeder
{
    public function run()
    {
         
         $name[1] = 'Comision 90%';
         $percentage[1] = 0.5;
        
         $name[2] = 'Comision 10%';
         $percentage[2] = 0.5;
        

         $name[3] = 'Cumpliendo sobre los estimado';
         $percentage[3] = 1.5;
  
             
             DB::table('commissions')->insert([
 
                 'id' => 1,
                 'commission1' => $name[1],
                 'percentage1' => $percentage[1],
                 'commission2' => $name[2],
                 'percentage2' => $percentage[2],
                 'commission3' => $name[3],
                 'percentage3' => $percentage[3],
                 'created_at'=> now(),
                 'updated_at'=> now(),
 
             ]);
 
        //  }
        
    }
}
