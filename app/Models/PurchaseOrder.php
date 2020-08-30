<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
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


    protected $table = "purchase_orders";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'phone',
        'address',
        'company_id',
        'provider_id'
    ];

    public function billtopay()// 1 a 1
    {
        return $this->hasMany('App\Models\BillToPay');
    }

    public function items()// M a N 
    {
        // return $this->belongsToMany('App\Models\Item');
        return $this->belongsToMany('App\Models\Item', 'item_purchase_orders')->withPivot('quantity','price');

    }

    public function typemovementinventory()// 1 a 1
    {

    return $this->hasOne('App\Models\TypeMovementInventory');
    }

    public function company()// n a 1
  {
    return $this->belongsTo('App\Models\Company');
  }

  public function provider()// n a 1
  {
    return $this->belongsTo('App\Models\Provider');

  }

}