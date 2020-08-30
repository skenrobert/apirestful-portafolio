<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AccounPlan extends Model
{
  use SoftDeletes;
    
    protected $table = "accoun_plan";

    protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'code',
    'despcrition',
    'accountings_id'
  ];


    public function accounting()//M a 1
    {
            return $this->belongsTo('App\Models\Acconting');
    }


    public function item()// M a N
    {
        return $this->belongsToMany('App\Models\Item');
    }

}
