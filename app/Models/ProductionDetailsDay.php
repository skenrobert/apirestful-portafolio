<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionDetailsDay extends Model
{
    use SoftDeletes;
       
    protected $table = "production_details_days";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
    // 'last_week',
    // 'progress_week',
    'tkn_total_day',
    'production_master_id',
    'dolar_total_day',
    'day_week',
    'observation_day'
    
  ];


    public function productiondetailsshift()
    {
        return $this->hasMany('App\Models\ProductionDetailsShift');
    }

    public function production_master()//m a 1
    {
        return $this->belongsTo('App\Models\ProductionMaster');
    }

    // public function shifthasproviders()//m a 1
    // {
    //     return $this->belongsTo('App\Models\ShiftHasEmployee');
    // }
}
