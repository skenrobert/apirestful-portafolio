<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class ReceiptPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ReceiptPayment::class, 20)->create();
        
    }
}
