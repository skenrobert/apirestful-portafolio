<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;


class ProductionDetailsDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductionDetailsDay::class, 30)->create();
        
    }
}
