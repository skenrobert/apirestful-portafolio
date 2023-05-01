<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class JobType extends Model
{
  use SoftDeletes;
       
    protected $table = "job_types";
    
    protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'description',
    'value_models',
    'satelite',
    'transport_aid',
    'food_aid',
    'additional_transport_assistance'
    // 'company_id'
    
  ];


  public function provider()// 1 a 1
  {

    return $this->hasOne('App\Models\Provider');
  }


  public function Employee()// 1 a 1
  {

    return $this->hasOne('App\Models\Employee');
  }


  public function jobfunctions()// 1 a m
  {
      return $this->hasMany('App\Models\JobFunction');
  }



}
