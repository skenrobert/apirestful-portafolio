<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComissionStudy extends Model
{
    
    use SoftDeletes;
 
    protected $table = "comission_studies";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
      
        'observation',
        'paycommission',
        'production',
        'commission',
        'event_id',
        'user_id'
        
    ];

    public function event()//1 a 1
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function company()//1 a 1
    {
        return $this->belongsTo('App\Models\Company');
    }
}
