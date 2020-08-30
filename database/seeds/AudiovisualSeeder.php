<?php

use Illuminate\Database\Seeder;

class AudiovisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Audiovisual::class, 10)->create();
        //
    }
}
