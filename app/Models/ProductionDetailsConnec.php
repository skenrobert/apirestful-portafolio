<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionDetailsConnec extends Model
{
    use SoftDeletes;

    protected $table = "production_details_connec";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'connection_start',
        'connection_end',
        'break_start',
        'break_end',
        'observation_int',
        'observation_end',
        'dolar_total_provider',
        'tkn_total_provider',
        'production_details_shift_id',
        'user_id'
        
    ];


    public function auditshift()//1 a 1
    {
        return $this->hasMany('App\Models\AuditShift');
    }

    public function events()//1 a m
    {
        return $this->hasMany('App\Models\Event');
    }

    public function production_details_shift()//n a 1
  {
      return $this->belongsTo('App\Models\ProductionDetailsShift');
  }

  public function user()//n a 1
  {
      return $this->belongsTo('App\Models\User');
  }

  public function accountproductiondetails()//n a m
  {
    //   return $this->belongsToMany('App\Models\Account');
    return $this->hasMany('App\Models\AccountProductionDetails');//,'accounts', 'productiondetailsconnec_id', 'account_id')->using('App\Models\AccountProductionDetails')
    // ->withPivot(
    //     'dolar',
    //     'tkn',
    //     'productiondetailsconnec_id',
    //     'account_id'
    // )->withTimestamps();
  }

}
