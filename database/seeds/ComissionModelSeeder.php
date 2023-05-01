<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComissionModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ComissionModel::class, 20)->create();
        
    }
}
