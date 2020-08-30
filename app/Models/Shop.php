<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shop extends Model
{
  use SoftDeletes;
    
    protected $table = "shops";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        
        'name',
        'description',
        'phone',
        'address',
        'company_id',
        'number_control'

    ];


    public function company(){// m a 1

        return $this->belongsTo('App\Models\Company');
    
      }

      public function inventory()// 1 a 1
      {
    
        return $this->hasOne('App\Models\Inventory');
      }

    //   public function Clients()//m a n
    // {
    //   return $this->belongsToMany('App\Client');
    // }

      public function bill_to_charge()// 1 a 1
      {
      
        return $this->hasMany('App\Models\BillToCharge');
      }
             
}
