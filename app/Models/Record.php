<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Record extends Model
{
    use SoftDeletes;
    
    protected $table = "records";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [        
        'user_id','company_id','course_id'
        
    ];


 
  public function user()//n a 1
  {
      return $this->belongsTo('App\Models\User');
  }

  public function trainings()//m a n 
  {
      return $this->hasMany('App\Models\Training');
  }

  public function company()//n a 1
  {
      return $this->belongsTo('App\Models\Company');
  }

  public function courses()//n a 1
  {
      return $this->belongsTo('App\Models\Courses');
  }

}
