<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use Faker\Generator;


class LockerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Models\Locker::class, 20)->create();

    }
}
