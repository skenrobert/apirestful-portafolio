<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model
{
    use SoftDeletes;

    protected $table = "subjects";

    protected $dates = ['deleted_at'];

    protected $fillable = [        
        'name',
        'description',
        'creditos',
        'referrer_subject_id',
        'course_id'

    ];

    //TODO: Relacion de dependencia

    public function trainings()//m a n 
    {
        return $this->hasMany('App\Models\Training');
    }

    public function course()// m a 1
    {
        return $this->belongsTo('App\Models\Course');
    }


    public function referrer_subject()//m a n 
    {
        return $this->hasOne('App\Models\Subject');
    }

    



}
