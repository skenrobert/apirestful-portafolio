<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobFunction extends Model
{
    use SoftDeletes;

    protected $table = "job_functions";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
      
        'name',
        'job_type_id'
     
    ];

    public function jobtype()// 1 a m
    {
        return $this->belongsTo('App\Models\JobType');
    }

    public function projecttask()//1 a m
    {
        return $this->hasMany('App\Models\ProjectTask');
    }
    
}

