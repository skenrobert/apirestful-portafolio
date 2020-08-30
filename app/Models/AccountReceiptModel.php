<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class AccountReceiptModel extends Model
{
//    use Sluggable;
    use SoftDeletes;


    // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }


    protected $table = "account_receipt_models";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'date',
        'token_pago',
        'dolar_pago',
        'pesos_pago',
        'retefuente',
        'total_pago',
        'document_number',
        'name',
        'bank_number',
        'start',
        'end',
        'observation',
        'token_mfc',
        'token_chat',
        'token_stripchat',
        'token_camsoda',
        'token_bongas',
        'token_cam4',
        'token_jasmin',
        'token_streamate',
        'token_manyvids',
        'token_naked',
        'token_youporn',
        'token_dirty',
        'dolar_mfc',
        'dolar_chat',
        'dolar_stripchat',
        'dolar_camsoda',
        'dolar_bongas',
        'dolar_cam4',
        'dolar_jasmin',
        'dolar_streamate',
        'dolar_manyvids',
        'dolar_naked',
        'dolar_youporn',
        'dolar_dirty',
        'pesos_mfc',
        'pesos_chat',
        'pesos_stripchat',
        'pesos_camsoda',
        'pesos_bongas',
        'pesos_cam4',
        'pesos_jasmin',
        'pesos_streamate',
        'pesos_manyvids',
        'pesos_naked',
        'pesos_youporn',
        'pesos_dirty',
        'user_id',
        'audiovisual',
        'conection',
        'audit',
        'auditshift',//room
        'rule_production',
        'other',
        'deductibility_total',
        'total_pesos',
        'accounting_id'
    ];
}
