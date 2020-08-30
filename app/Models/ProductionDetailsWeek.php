<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionDetailsWeek extends Model
{
    
    use SoftDeletes;
    // use Sluggable;
  
    //   public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //       return [
    //           'slug' => [
    //               'source' => 'name'
    //           ]
    //       ];
    //   }
  
    //   protected static function boot()//TODO: implementacion de los Scope ojo implementar en tablas relaciones tener cuidado mas efectivo id firttofail o lo otro es scope modificando el boot del modelo
      // {
      // 	parent::boot();
      // 	static::addGlobalScope(new ProviderScope);
      // }
  
      protected $table = "production_details_week";
  
      protected $dates = ['deleted_at'];
  
      protected $fillable = [        
        'dolar_total_week',
        'observation_week',
        'productionmaster_id',
        'shifthasplanning_id'
      ];

      public function shifthasplanning()//m a 1
      {
          return $this->belongsTo('App\Models\ShiftHasPlanning');
      }

      public function productiondetailsdays()//1 a m
      {
          return $this->hasMany('App\Models\ProductionDetailsDay');
      }

      public function productionmaster()//m a 1
      {
          return $this->belongsTo('App\Models\ProductionMaster');
      }

      
    public function compareproviderweek()//1 a 1
    {
        return $this->hasOne('App\Models\CompareProviderWeek');
    }

       //************************************************************************************ */


//************************************************************************************ */
}




