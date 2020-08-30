<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionDetailsShift extends Model
{
    use SoftDeletes;
       
    protected $table = "production_details_shift";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [

    'dolar_total_monitor_shift',//->default(12000,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
    'observation_shift',//total en dolares de la modelo
    'tkn_total_monitor',//se basa en sacar la estimacion de toda la semana 
    'production_details_day_id',
    'monitor_shift_id'
    
  ];


  public function production_details_day()//m a 1
  {
      return $this->belongsTo('App\Models\ProductionDetailsDay');
  }

  public function productiondetailsconnec()//1 a m 
    {
        return $this->hasMany('App\Models\ProductionDetailsConnec');
    }

    // public function shift()//m a 1
    // {
    //     return $this->belongsTo('App\Models\Shift');
    // }

    // public function employees()//m a 1
    // {
    //     return $this->belongsTo('App\Models\Employee');
    // }

    public function monitor_shift()//m a 1
    {
        return $this->belongsTo('App\Models\MonitorShift');
    }

}
