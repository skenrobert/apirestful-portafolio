<?php

namespace App\Imports;
use App\Models\BulkLoad;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

// class FirstSheetImport implements ToCollection
// class FirstSheetImport implements WithMappedCells, ToModel 
class FirstSheetImport implements ToModel
{

    use Importable;

    public function model(array $row)
    {
        return new BulkLoad([
            // 'document_number' => $row['CEDULA'],
            // 'nickname' => $row['MFC'],
            // 'total_tokens' => $row['MFC'],

            'document_number' => ($row[2] == 'CEDULA' Or $row[2] == 'ID' ) ? NULL : $row[2],
            'name' => ($row[4] == 'NOMBRE COMPLETO' Or $row[4] == 'NOMBRE' ) ? NULL : $row[4],

            'start' => $row[0],
            'end' => $row[1],
            
            'nickname_mfc' => ($row[5] == 'MFC NICK' Or $row[5] == 'MFC' ) ? NULL : $row[5],
            'token_mfc' => ($row[27] == 'MFC TOKENS' Or $row[27] == '' ) ? NULL : $row[27],

            'nickname_chat' => ($row[6] == 'CHATURBATE NICK' Or $row[6] == 'CHAT' ) ? NULL : $row[6],
            'token_chat' => ($row[30] == 'CHAT' Or $row[30] == '' ) ? NULL : $row[30],

            'nickname_stripchat' => ($row[7] == 'STRIPCHAT NICK' Or $row[7] == 'STRIPCHAT' ) ? NULL : $row[7],
            'token_stripchat' => ($row[33] == 'STRIPCHAT' Or $row[33] == '' ) ? NULL : $row[33],

            // 'nickname_camsoda' => ($row[] == 'MFC NICK' Or $row[3] == 'MFC' ) ? NULL : $row[5],//
            'token_camsoda' => ($row[36] == 'CAMSoda' Or $row[36] == '' ) ? NULL : $row[36],//

            'nickname_bongas' => ($row[8] == 'BONGASCAM NICK' Or $row[8] == 'BONG' ) ? NULL : $row[8],
            'token_bongas' => ($row[39] == 'BONGASCAM' Or $row[39] == '' ) ? NULL : $row[39],

            'nickname_cam4' => ($row[9] == 'CAM4  NICK' Or $row[9] == 'CAM4' ) ? NULL : $row[9],
            'token_cam4' => ($row[41] == 'CAM 4' Or $row[41] == '' ) ? NULL : $row[41],

            'nickname_jasmin' => ($row[10] == 'LIVE JASMIN NICK' Or $row[10] == 'LIVEJASMIN' ) ? NULL : $row[10],
            'token_jasmin' => ($row[43] == 'LIVE JASMIN' Or $row[43] == '' ) ? NULL : $row[43],

            'nickname_streamate' => ($row[11] == 'STREAMATE NICK' Or $row[11] == 'STREAMATE' ) ? NULL : $row[11],
            'token_streamate' => ($row[46] == 'STREAMATE DOLARES' Or $row[46] == '' ) ? NULL : $row[46],//dolares

            'nickname_manyvids' => ($row[12] == 'MANYVIDS NICK' Or $row[12] == 'MANYVIDS' ) ? NULL : $row[12],
            'token_manyvids' => ($row[48] == 'MANYVIDS DOLARES' Or $row[48] == '' ) ? NULL : $row[48],//dolares

            'nickname_youporn' => ($row[13] == 'YOUPORN NICK' Or $row[13] == 'YOUPORN' ) ? NULL : $row[13],
            'token_youporn' => ($row[50] == 'NAKED DOLARES' Or $row[50] == '' ) ? NULL : $row[50],//dolares

            'nickname_naked' => ($row[14] == 'NAKED NICK' Or $row[14] == 'NAKED' ) ? NULL : $row[14],
            'token_naked' => ($row[52] == 'YOUPORN DOLARES' Or $row[52] == '' ) ? NULL : $row[52],//dolares

            'nickname_dirty' => ($row[15] == 'DIRTY NICK' Or $row[15] == 'DIRTY' ) ? NULL : $row[15],
            'token_dirty' => ($row[54] == 'DIRTY DOLARES' Or $row[54] == '' ) ? NULL : $row[54],//dolares

            // 'retefuente' => $row[60],
        ]);
    }


    // public function model(array $row)
    // {
    //     // dd($row[2]);
    //     return new BulkLoad([//insertar por pagina colocar condicional que si esa modelo tienen toque la guarda para evitar que el de error por basio igual de bueno poner un condicion que si es bacio ? esto : o esto
            
    //         'document_number' => $row[2],
    //         'nickname' => $row[3],
    //         'total_tokens' => $row[3],

    //         //  'document_number' => $row[2],
    //         // 'nickname' => $row[3],
    //         // 'total_tokens' => $row[4],



    //         // 'is_active' => ($row['active'] == 'YES') ? 1 : 0,

    //     ]);
    // }
}






// namespace App\Imports;
 
// use App\Vehicle;
// use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};
 
// class VehiclesImport implements ToModel, WithHeadingRow
// {
//     use Importable;
 
//     public function model(array $row)
//     {
//         return new Vehicle([
//             'registration_number' => $row['registration_number'],
//             'brand' => $row['brand'],
//             'model' => $row['model'],
//             'type' => $row['type'],
//             'fuel_type' => $row['fuel_type'],
//             'year' => (integer) $row['year'],
//             'doors' => (integer) $row['doors'],
//             'is_active' => ($row['active'] == 'YES') ? 1 : 0,
//         ]);
//     }
// }