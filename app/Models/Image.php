<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "images";
    
    protected $fillable = [
      'name',
    ];

    // TODO: el withTimestamps debe ir en las funciones respectiva de los modelos pivote de los metodos images 
    public function provider()
    {
        return $this->belongsToMany('App\Models\Provider');//->withTimestamps();
    }

    public function company()
    {
        return $this->belongsToMany('App\Models\Company');//->withTimestamps();
    }

    public function accountrequest()
    {
        return $this->belongsToMany('App\Models\AccountRequest');//->withTimestamps();
    }

    public function boutique()
    {
        return $this->belongsToMany('App\Models\Boutique');//->withTimestamps();
    }

    public function auditshift()
    {
        return $this->belongsToMany('App\Models\AuditShift');//->withTimestamps();
    }

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');//->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany('App\Models\User');//->withTimestamps();
    }

    public function audiovisual()
    {
        return $this->belongsToMany('App\Models\Audiovisual');//->withTimestamps();
    }

    public function contract()
    {
        return $this->belongsToMany('App\Models\Contract');//->withTimestamps();
    }
}
