<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class ProductionDetailsShiftSeeder extends Seeder
{
    
    public function run()
    {
        factory(App\Models\ProductionDetailsShift::class, 30)->create();
        
    }
}
