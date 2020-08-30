<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    // use SoftDeletes;
  
    protected $table = "event_types";
    
    // protected $dates = ['deleted_at'];

    protected $fillable = [
    'name',
    'description',
    'value',
    'type',
    'company_id'
         
    ];

    public function event()// 1 a 1
    {
        return $this->hasMany('App\Models\Event');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
}
