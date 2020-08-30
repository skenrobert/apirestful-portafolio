<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;


class ProductionMasterSeeder extends Seeder
{
    
    public function run()
    {
        factory(App\Models\ProductionMaster::class, 30)->create();
        
    }
}
