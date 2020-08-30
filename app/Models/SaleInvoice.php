<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SaleInvoice extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = "sales_invoice";

    protected $fillable = [
        'number',
        'description_null',
        'total',
        'sub_total',
        'details',//json       
        'bill_to_charge_id'
    
    ];


    public function accounting()// 1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }


    public function bill_to_charge()//1 a 1
    {
        return $this->belongsTo('App\Models\BillToCharge');
    }

}
