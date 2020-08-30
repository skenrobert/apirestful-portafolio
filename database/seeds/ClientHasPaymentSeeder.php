<?php

use Illuminate\Database\Seeder;
use App\Models\ClientHasPayment;


class ClientHasPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ClientHasPayment::class, 6)->create();
        
    }
}
