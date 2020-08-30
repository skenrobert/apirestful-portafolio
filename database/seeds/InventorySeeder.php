<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    
    public function run()
    {
        factory(App\Models\Inventory::class, 10)->create();
    }
}
