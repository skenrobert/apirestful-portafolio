<?php

namespace App\Imports;

use App\Models\BulkLoad;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

// class ModelsImport implements WithMultipleSheets, SkipsUnknownSheets
class ModelsImport implements WithMultipleSheets, SkipsUnknownSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     // dd($row[2]);
    //     return new BulkLoad([//insertar por pagina colocar condicional que si esa modelo tienen toque la guarda para evitar que el de error por basio igual de bueno poner un condicion que si es bacio ? esto : o esto
            
    //         'document_number' => $row[1],
    //         'nickname' => $row[2],
    //         'total_tokens' => $row[3],

    //         //  'document_number' => $row[2],
    //         // 'nickname' => $row[3],
    //         // 'total_tokens' => $row[4],

    //     ]);
    // }


    public function sheets(): array
    {
        return [
            // 'DISEÑO' => new FirstSheetImport(),
            0 => new FirstSheetImport(),
            // 'Worksheet 2' => new SecondSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found. El nombre de la hoja solicitada [DISENO] está fuera de los límites.
        info("El nombre de la hoja solicitada {$sheetName} está fuera de los límites.");
    }

}


