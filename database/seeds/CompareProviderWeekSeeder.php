<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CompareProviderWeekSeeder extends Seeder
{
   
    public function run()
    {
        factory(App\Models\CompareProviderWeek::class, 20)->create();
        
    }
}
