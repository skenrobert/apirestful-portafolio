<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AuditShift extends Model
{
    use SoftDeletes;

    protected $table = "audit_shifts";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'location',
        'bed',
        'cleaning',
        'tv',
        'pc',
        'cam',
        'object',
        'confirmed',
        'production_details_connec_id'

    ];


    public function event()//1 a m
    {
        return $this->hasMany('App\Models\Event');
    }

    public function production_details_connec()//m a 1
    {
        return $this->belongsTo('App\Models\ProductionDetailsConnec');
    }

    public function monitordelivery()//n a 1
    {
        return $this->belongsTo('App\Models\User');
    } 
  
    public function monitorreceives()//n a 1
    {
        return $this->belongsTo('App\Models\User');
    } 

    public function images()
    {
         return $this->belongsToMany('App\Models\Image')->withTimestamps();
    }
    
}
