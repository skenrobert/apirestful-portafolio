<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Person::class, 50)->create();
        factory(App\Models\Employee::class, 50)->create();
        // factory(App\Models\Client::class, 50)->create();
        factory(App\Models\Provider::class, 50)->create();
        factory(App\Models\User::class, 50)->create();
        //factory(App\Models\Room::class, 100)->create();
        factory(App\Models\Locker::class, 50)->create();

    }
}
