<?php

use Illuminate\Database\Seeder;
use App\Models\BillToPay;

class BillToPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BillToPay::class, 10)->create();
        
    }
}
