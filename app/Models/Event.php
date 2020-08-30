<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = "events";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'observation',
        'processed',
        'event_type_id',
        'audists_shift_id',
        'audists_id',
        'user_id',//quien recibe
        'model_id',//quien recibe
        'create_event_id',//quien otorga
        'payroll_id',
        'productiondetailsconnec_id',
        'production_master_id',
        'company_id',
        'value_real'
  ];
// TODO: los empleados tambien deben guardar su id en el evento para cuestiones de estadisticas

    // public function employee()//n a 1
    // {
    //     return $this->belongsTo('App\Models\Employee');

    // }

    public function company()//n a 1
    {
        return $this->belongsTo('App\Models\Company');
  
    }

    public function productiondetailsconnec()//n a 1
    {
        return $this->belongsTo('App\Models\ProductionDetailsConnec');
  
    }

  public function model()//n a 1
  {
      return $this->belongsTo('App\Models\User');

  }

  public function user()//n a 1
  {
      return $this->belongsTo('App\Models\User');

  }

  public function create_event()//n a 1
  {
      return $this->belongsTo('App\Models\User');

  }

  public function eventType()// 1 a 1
    {
        return $this->belongsTo('App\Models\EventType');
    }

    public function payroll()//1 a 1
    {
        return $this->belongsTo('App\Models\Payroll');
    }

    public function audits()//1 a 1
    {
        return $this->belongsTo('App\Models\Audit');
    }

    public function auditshift()//1 a m
    {
        return $this->belongsTo('App\Models\AuditShift');
    }

    public function billtocharge()// 1 a 1
    {
        return $this->hasOne('App\Models\BillToCharge');
    }

    public function billtopay()// 1 a 1
    {
        return $this->hasMany('App\Models\BillToPay');
    }

      public function productionmaster()//n a 1
    {
        return $this->belongsTo('App\Models\ProductionMaster');
  
    }

    public function receiptpayment() //1 a m
    {
        return $this->hasMany('App\Models\ReceiptPayment');
    }

    // public function productionmasters() //1 a m
    // {
    //     return $this->belongsTo('App\Models\ProductionMaster');
    // }

    public function audiovisual(){// 1 a M

        return $this->belongsTo('App\Models\Audiovisual');
   } 
}
