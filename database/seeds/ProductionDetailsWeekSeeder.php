<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class ProductionDetailsWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductionDetailsWeek::class, 20)->create();
        
    }
}
