<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptPayment extends Model
{
    use SoftDeletes;
 
    protected $table = "receipt_of_payment";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'observation',
        'pay_salary',
        'event_id',
        'user_id',
        'payroll_id',
        'paycommission',
        'commission',
        'production',
        'ret_fte',
        'value_collect',
        'value_pay',
        'number_receipt'
    ];


    public function payroll()//1 a 1
    {
        return $this->belongsTo('App\Models\Payroll');
    }

    public function event()//1 a 1
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function user()//n a 1
    {
        return $this->belongsTo('App\Models\User');
  
    }
}
