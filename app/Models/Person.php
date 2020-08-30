<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Person extends Model
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

    protected $table = "people";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
            'name',
            'last_name',
            'mobile_phone',
            'phone',
            'birthdate',
            'address',
            'document_type',
            'document_number',
            'sigin',
            'rut',
            'gender',
            'nationality',
            'bank_account',
            'banks_id',
            'epss_id'

  ];

  public function employee(){// 1 a 1

    return $this->hasOne('App\Models\Employee');
  }

  public function client(){// 1 a 1

    return $this->hasOne('App\Models\Client');
    
  }

  public function provider(){// 1 a 1

    return $this->hasOne('App\Models\Provider');
  }
    
  public function user()// 1 a 1
  {

    return $this->hasOne('App\Models\User');
  }
  
  public function epss()//n a 1
  {
      return $this->belongsTo('App\Models\Eps');
  }

  public function record()// 1 a 1
  {

    return $this->hasOne('App\Models\Record');
  }

  public function banks()//n a 1
  {
      return $this->belongsTo('App\Models\Bank');
  }

  public function companies()// m a n
  {
      return $this->belongsToMany('App\Models\Company')->withTimestamps();
  }

  public function clienthaspayment()// 1 a M
  {

    return $this->hasMany('App\Models\ClientHasPayment');
  }
}
