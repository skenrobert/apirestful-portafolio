<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {

        factory(App\Models\Contact::class, 50)->create();

    }
}
