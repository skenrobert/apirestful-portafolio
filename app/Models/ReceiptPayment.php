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
      
        'name',
        'document_number',
        'worked_days',
        'pay_salary',
        'pay_transport_aid',
        'pay_additional_transport',
        'pay_food_aid',
        'health',
        'pension',
        'total_income',
        'total_discounts',
        'total_pay',
        'number_receipt',
        'payroll_id',
        'event_id',
        'user_id'

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
