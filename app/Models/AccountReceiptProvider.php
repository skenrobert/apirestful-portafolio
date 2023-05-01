<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountReceiptProvider extends Model
{
    
    use SoftDeletes;

    protected $table = "account_receipt_providers";
    
    protected $dates = ['deleted_at'];


    protected $fillable = [
                            'control_number',
                            'document_number',
                            'name',
                            'bank_number',
                            'concept',
                            // 'date',
                            'value',
                            'rte_fte',
                            'rete_ica',
                            'value_pay',
                            'value_pay_tex',
                            'event_id',
                            'provider_id'
    ];


    public function provider(){
        return $this->belongsTo('App\Models\Provider');
    }


    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function company()//m a n
    {
        return $this->belongsToMany('App\Models\Company');
    }
    
}
