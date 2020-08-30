<?php

use Illuminate\Database\Seeder;
use App\Models\Accounting;

class AccountingSeeder extends Seeder
{
  
    public function run()
    {
        factory(App\Models\Accounting::class, 10)->create();
        //
    }
}
