<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bank extends Model
{

  use Sluggable;
  use SoftDeletes;

  public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }
  
    protected $table = "banks";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
            
    'name',
    'description',
    'phone',
    'address'
  ];

  public function person()// 1 a m
  {
      return $this->hasMany('App\Models\Person');
  }


  
}
