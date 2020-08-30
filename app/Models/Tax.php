<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $table = "taxes";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'value'
    ];


    public function item()//M a N
    {
        return $this->belongsToMany('App\Models\Item');
    }


}
