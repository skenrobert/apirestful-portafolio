<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Shop::class, 10)->create();
    }
}
