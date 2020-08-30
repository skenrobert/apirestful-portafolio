<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class BillToPay extends Model
{

    use SoftDeletes;
    use Sluggable;

        public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
            return [
                'slug' => [
                    'source' => 'description'
                ]
            ];
        }


        protected $table = "bill_to_pays";
        
        protected $dates = ['deleted_at'];

        protected $fillable = [
    
            'description',
            'way_to_pay',
            'transfer_code',
            'quantity',
            'total_cost',
            'total_paid',
            'accounting_id',
            'event_id',
            'owner_id',
            'production_system'
            
            // 'company_id'
    
        ];



    public function accounting()// 1 a 1
    {
        return $this->belongsTo('App\Models\Accounting');
    }
    
    public function payorders()// 1 a 1
    {
        return $this->hasMany('App\Models\PayOrder');
    }

    public function billtocharge()// 1 a 1
    {
        return $this->hasOne('App\Models\BillToCharge');
    }

    // public function company()// 1 a M
    // {
    //     return $this->belongsTo('App\Models\Company');
    // }

    public function events()// M a n
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function purchaseorder()// M a n
    {
        return $this->belongsTo('App\Models\PurchaseOrder');
    }

    
    public function owner()// 1 a 1
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()//m a n
    {
        // return $this->belongsToMany('App\Models\Provider');
        return $this->belongsToMany('App\Models\User', 'bill_to_pay_user')->withPivot('paid')->withTimestamps();
    }

    public function study()//m a n// TODO: tengo que crear otra tabla sino va ser una realcion ternaria inecesaria
    {
        // return $this->belongsToMany('App\Models\Provider');
        return $this->belongsToMany('App\Models\Company', 'bill_to_pay_company')->withPivot('paid')->withTimestamps();
    }
}
