<?php

use App\Models\TypeMovementInventory;
use Illuminate\Database\Seeder;

class TypeMovementInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TypeMovementInventory::class, 10)->create();
        //
    }
}
