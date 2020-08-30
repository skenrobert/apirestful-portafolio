<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eps extends Model
{
    use SoftDeletes;

    protected $table = "epss";
    protected $dates = ['deleted_at'];

    protected $fillable = [
              'name'
            ];


    public function person()// 1 a m
    {
        return $this->hasMany('App\Models\Person');
    }
  
}
