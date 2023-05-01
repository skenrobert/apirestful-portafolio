<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComissionModel extends Model
{
    use SoftDeletes;
 
    protected $table = "comission_models";
    
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

    public function user()//1 a 1
    {
        return $this->belongsTo('App\Models\User');
    }
}
