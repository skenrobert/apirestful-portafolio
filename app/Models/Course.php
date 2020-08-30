<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    
    protected $table = "courses";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [        
        'name',
        'description',
        'schedule_id'
    ];
    

    public function records()// m a 1
    {
        return $this->hasMany('App\Models\Record');
    }
    

    public function shedule()//1 a m
    {
        return $this->belongsTo('App\Models\Shedule');
    }

    public function subject()//1 a m
    {
        return $this->hasMany('App\Models\Subject');
    }
    
}
