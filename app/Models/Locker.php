<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Locker extends Model
{
  use SoftDeletes;
    
  use Sluggable;

  public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }


    protected $table = "lockers";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
            
    'number',
    'location',
    'status',
    'company_id'


  ];

  public function company() //1 a m
  {
      return $this->belongsTo('App\Models\Company');
  }

  public function providers()//m a n
  {
      return $this->belongsToMany('App\Models\Provider');
  }



}
