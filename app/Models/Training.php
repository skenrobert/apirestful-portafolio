<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;



class Training extends Model
{
    use SoftDeletes;
    

    use Sluggable;

    public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
        return [
            'slug' => [
                'source' => 'observation'
            ]
        ];
    }

    protected $table = "trainings";

    protected $dates = ['deleted_at'];


    protected $fillable = [        
       'note','observation','record_id','subject_id'
    ];



    public function record()//m a n 
    {
        return $this->belongsTo('App\Models\Record');
    }

    // public function courses()// 1 a m
    // {
    //     return $this->hasMany('App\Models\Course');
    // }

    public function subject()//m a n
  {
      return $this->belongsTo('App\Models\Subject');
  }

}
