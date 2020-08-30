<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;


class AudistsShiftSeeder extends Seeder
{
  
    public function run()
    {
        factory(App\Models\AudistsShift::class, 20)->create();
        
    }
}
