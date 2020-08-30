<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audists extends Model
{
    use SoftDeletes;
    

    protected $dates = ['deleted_at'];



    public function event() //1 a m
    {
        return $this->hasMany('App\Models\Event');
    }

    public function productionmaster()//m a 1
    {
        return $this->belongsTo('App\Models\ProductionMaster');
    }

}
