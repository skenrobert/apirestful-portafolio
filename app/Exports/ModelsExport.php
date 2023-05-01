<?php

namespace App\Exports;

use App\Models\BulkLoad;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ModelsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BulkLoad::all();
        // return User::all();
    }
}
