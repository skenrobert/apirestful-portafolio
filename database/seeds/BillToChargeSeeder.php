<?php

use Illuminate\Database\Seeder;
use App\Models\BillToCharge;

class BillToChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BillToCharge::class, 20)->create();
        
    }
}
