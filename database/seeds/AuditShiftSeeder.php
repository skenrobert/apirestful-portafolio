<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;


class AuditShiftSeeder extends Seeder
{
  
    public function run()
    {
        factory(App\Models\AuditShift::class, 20)->create();
        
    }
}
