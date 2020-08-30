<?php

use Illuminate\Database\Seeder;

class SheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Shedule::class, 10)->create();
        
    }
}
