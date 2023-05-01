<?php

use Illuminate\Database\Seeder;
use App\Models\AccountReceiptProvider;

class AccountReceiptProviderSeeder extends Seeder
{
    
    public function run()
    {
        factory(App\Models\AccountReceiptProvider::class, 10)->create();
        
    }
}
