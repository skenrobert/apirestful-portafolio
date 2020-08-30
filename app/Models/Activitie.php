<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    
    protected $table = "projects";

    protected $dates = ['deleted_at'];

    protected $fillable = [
      
        'activity',
        'referrer_activities_id',
        'description',
        'projects_id',
        'shifts_id'

  
    ];


    
    public function projecttask()//1 a m
    {
        return $this->hasMany('App\Models\ProjectTask');
    }


    public function project()// m a 1
    {
        return $this->belongsTo('App\Models\Project');
    }
    

    public function shift()//m a 1
    {
        return $this->belongsTo('App\Models\Shift');
    }
}
