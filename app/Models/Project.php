<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
  use SoftDeletes;

    protected $table = "projects";

    protected $dates = ['deleted_at'];

  protected $fillable = [
    'companies_id'   
  ];

  public function activity()//1 a m
  {
      return $this->hasMany('App\Models\Activity');
  }

 
  public function resource()//1 a m
  {
      return $this->hasMany('App\Models\Resource');
  }
    
  public function company()//m a 1
  {
      return $this->belongsTo('App\Company');
  }

}
