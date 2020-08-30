<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Accounting extends Model
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



    protected $table = "accountings";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'inventory_id',
        'payroll_id',
        'company_id'

    ];


     public function billtopay()// 1 a M
    {

        return $this->hasMany('App\Models\BillToPay');
    }

    public function billtocharge()// 1 a M
    {

        return $this->hasMany('App\Models\BillToCharge');
    }

    public function payroll()// 1 a 1
    {

    return $this->hasOne('App\Models\Payroll');
    }

    public function inventory()// 1 a 1
    {

    return $this->hasOne('App\Models\Inventory');
    }

    public function accountplan()// 1 a M
    {
  
      return $this->hasMany('App\Models\AccountPlan');
    }

    public function sales_invoice()// 1 a 1
    {

    return $this->hasOne('App\Models\SaleInvoice');
    }

    public function company()// 1 a 1
    {

    return $this->belongsTo('App\Models\Company');
    }


    public function bulkload()// 1 a M
    {

        return $this->hasMany('App\Models\BulkLoad');
    }

}
