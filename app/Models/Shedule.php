<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shedule extends Model
{
    use SoftDeletes;
    

    protected $table = "schedules";
    protected $dates = ['deleted_at'];

    protected $fillable = [        
        'beginning',
        'end',
        'hour_beginning',
        'hour_end',
        'observation'
    ];

    public function courses()// m a 1
    {
        return $this->hasMany('App\Models\Course');
    }
            
}
