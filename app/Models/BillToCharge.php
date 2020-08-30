<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class BillToCharge extends Model
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

    protected $table = "bill_to_charges";

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'description',
        'total_paid',
        'quantity',
        'total_cost',
        'events_id',
        'shops_id',
        'accounting_id',
        'bill_to_pay_id',
        'production_system'


    ];


    public function accounting()// 1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }

    public function shop()// 1 a 1
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function sale_invoice()// 1 a 1
    {
        return $this->hasOne('App\Models\SaleInvoice');
    }

//   public function inventories()// relacion polimorfica que se asocia con la tabla responsables de type_movement_has_incentories
//   {
//   return $this->morphToMany('App\Models\Inventory', 'typemovementhasincentories');
//   }

    // public function movementtype()//1 a m
    // {
    //     return $this->hasMany('App\Models\MovementType');
    // }

    public function event()//1 a 1
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function company() //1 a m
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function typemovementinventory()
    {
        return $this->hasMany('App\Models\TypeMovementInventory');
    }

    public function clienthaspayment()// 1 a M
    {
  
      return $this->hasMany('App\Models\ClientHasPayment');
    }


    public function billtopay() //1 a m
    {
        return $this->belongsTo('App\Models\BillToPay');
    }


}
