<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audit extends Model
{
    protected $table = "audits";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        // 'nickname',
        // 'description',
        // 'password',
        // 'create_date',
        // 'email',
        // 'status',
        // 'site_id',
        // 'user_request_id',
        // 'provider_id',
        // 'company_id'

    ];



    public function event() //1 a m
    {
        return $this->hasMany('App\Models\Event');
    }

    public function productionmaster()//m a 1
    {
        return $this->belongsTo('App\Models\ProductionMaster');
    }

}
