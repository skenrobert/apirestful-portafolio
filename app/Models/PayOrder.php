<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class PayOrder extends Model
{

    // use Sluggable;
    use SoftDeletes;

    // public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //     return [
    //         'slug' => [
    //             'source' => 'description'
    //         ]
    //     ];
    // }


    protected $table = "pay_order";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'number',
        'quantity',
        'cost',
        'description',
        'total',
        'bill_to_pay_id'
    ];

    public function billtopay()// 1 a 1
    {
        return $this->belongsTo('App\Models\BillToPay');
    }

   

}
