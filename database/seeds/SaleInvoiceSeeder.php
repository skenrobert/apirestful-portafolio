<?php

use Illuminate\Database\Seeder;

class SaleInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SaleInvoice::class, 10)->create();
    }
}
