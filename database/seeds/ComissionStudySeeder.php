<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComissionStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ComissionStudy::class, 20)->create();
        
    }
}
